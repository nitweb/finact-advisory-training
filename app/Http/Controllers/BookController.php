<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\BookOrderThankYouMail;
use App\Services\SmsService;
use Illuminate\Support\Facades\Mail;

class BookController extends Controller
{
    const CART_KEY = 'book_cart';

    // ── Book Listing (Professional Academy > Books) ──
    public function BookList()
    {
        $book_list = Book::where('status', 'active')->latest()->paginate(9);
        return view('frontend.pages.book_list', compact('book_list'));
    }

    public function BookDetails($slug)
    {
        $book = Book::where('slug', $slug)->where('status', 'active')->firstOrFail();
        return view('frontend.details.book_details', compact('book'));
    }

    // Inline sample PDF preview
    public function BookSample($slug)
    {
        $book = Book::where('slug', $slug)->where('status', 'active')->firstOrFail();

        if (!$book->sample_pdf || !file_exists(public_path($book->sample_pdf))) {
            abort(404);
        }

        return response()->file(public_path($book->sample_pdf), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($book->sample_pdf) . '"',
        ]);
    }

    // ── Cart (session based) ──
    protected function cart(): array
    {
        $cart = Session::get(self::CART_KEY, []);

        if (empty($cart)) {
            return $cart;
        }

        // Keep cart prices in sync with current book prices/discounts
        $books = Book::whereIn('id', array_keys($cart))->get()->keyBy('id');
        foreach ($cart as $id => $item) {
            $book = $books->get($id);
            if ($book) {
                $cart[$id]['price'] = $book->final_price;
                $cart[$id]['original_price'] = $book->price;
                $cart[$id]['discount_percent'] = $book->has_discount ? (int) $book->discount_percent : 0;
            }
        }

        return $cart;
    }

    public function CartAdd(Request $request, $id)
    {
        $book = Book::where('status', 'active')->findOrFail($id);
        $wantsJson = $request->expectsJson() || $request->ajax();

        if ($book->stock < 1) {
            if ($wantsJson) {
                return response()->json(['success' => false, 'message' => 'This book is out of stock.'], 422);
            }
            return redirect()->back()->with('error', 'This book is out of stock.');
        }

        $qty = max(1, (int) $request->input('quantity', 1));

        $cart = $this->cart();

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                'book_id'  => $book->id,
                'title'    => $book->title,
                'price'    => $book->final_price,
                'original_price'   => $book->price,
                'discount_percent' => $book->has_discount ? (int) $book->discount_percent : 0,
                'cover'    => $book->cover_image,
                'quantity' => $qty,
            ];
        }

        $message = '"' . $book->title . '" added to cart.';

        // Don't allow more than available stock
        if ($cart[$id]['quantity'] > $book->stock) {
            $cart[$id]['quantity'] = $book->stock;
            $message = 'Only limited copies available. "' . $book->title . '" updated in your cart.';
        }

        Session::put(self::CART_KEY, $cart);

        $cart_count = collect($cart)->sum('quantity');

        if ($wantsJson) {
            return response()->json([
                'success'    => true,
                'message'    => $message,
                'cart_count' => $cart_count,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function CartView()
    {
        $cart = $this->cart();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('frontend.pages.book_cart', compact('cart', 'total'));
    }

    public function CartUpdate(Request $request, $id)
    {
        $cart = $this->cart();
        $qty = max(1, (int) $request->input('quantity', 1));

        if (isset($cart[$id])) {
            $book = Book::find($id);

            if (!$book || $book->stock < 1) {
                unset($cart[$id]);
                Session::put(self::CART_KEY, $cart);
                return redirect()->route('frontend.book.cart')
                    ->with('error', 'This book is no longer in stock and was removed from your cart.');
            }

            if ($qty > $book->stock) {
                $qty = $book->stock;
            }
            $cart[$id]['quantity'] = $qty;
            Session::put(self::CART_KEY, $cart);
        }

        return redirect()->route('frontend.book.cart');
    }

    // AJAX cart quantity update — returns JSON, no page reload
    public function CartUpdateAjax(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->cart();
        $qty = max(1, (int) $request->input('quantity', 1));

        if (!isset($cart[$id])) {
            return response()->json(['success' => false, 'message' => 'Item not found in cart.'], 404);
        }

        $book = Book::find($id);

        if (!$book || $book->stock < 1) {
            unset($cart[$id]);
            Session::put(self::CART_KEY, $cart);
            return response()->json([
                'success' => false,
                'removed' => true,
                'message' => 'This book is no longer in stock and was removed from your cart.',
            ], 422);
        }

        $max_note = null;
        if ($qty > $book->stock) {
            $qty = $book->stock;
            $max_note = 'Quantity limited to available stock.';
        }

        $cart[$id]['quantity'] = $qty;
        Session::put(self::CART_KEY, $cart);

        $cart_total = 0;
        $cart_count = 0;
        foreach ($cart as $item) {
            $cart_total += $item['price'] * $item['quantity'];
            $cart_count += $item['quantity'];
        }

        return response()->json([
            'success'      => true,
            'quantity'     => $cart[$id]['quantity'],
            'item_subtotal' => $cart[$id]['price'] * $cart[$id]['quantity'],
            'cart_total'   => $cart_total,
            'cart_count'   => $cart_count,
            'note'         => $max_note,
        ]);
    }

    public function CartRemove($id)
    {
        $cart = $this->cart();
        unset($cart[$id]);
        Session::put(self::CART_KEY, $cart);
        return redirect()->route('frontend.book.cart');
    }

    // ── Checkout ──
    public function CheckoutPage()
    {
        $cart = $this->cart();

        if (empty($cart)) {
            return redirect()->route('frontend.book.cart')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $site_setting = siteSetting();
        $delivery_charges = [
            'inside_dhaka'  => (int) ($site_setting->inside_dhaka_charge ?? 0),
            'outside_dhaka' => (int) ($site_setting->outside_dhaka_charge ?? 0),
            'suburbs'       => (int) ($site_setting->suburbs_charge ?? 0),
        ];

        return view('frontend.pages.book_checkout', compact('cart', 'total', 'delivery_charges'));
    }

    // Creates the order (stock reserved immediately). Payment is verified manually by admin.
    public function CheckoutSubmit(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:120',
            'phone'          => 'required|string|max:30',
            'email'          => 'nullable|email|max:120',
            'address'        => 'required|string|max:255',
            'note'           => 'nullable|string|max:500',
            'delivery_zone'  => 'required|in:inside_dhaka,outside_dhaka,suburbs',
            'payment_method' => 'required|in:bkash,cod',
            'bkash_number'   => ['required_if:payment_method,bkash', 'nullable', 'regex:/^(?:\+?88)?01[3-9]\d{8}$/'],
            'bkash_trx_id'   => ['required_if:payment_method,bkash', 'nullable', 'string', 'max:100', 'unique:orders,bkash_trx_id'],
        ], [
            'bkash_number.required_if' => 'Your bKash number is required.',
            'bkash_number.regex'       => 'Please enter a valid bKash number.',
            'bkash_trx_id.required_if' => 'bKash Transaction ID is required.',
            'bkash_trx_id.unique'      => 'This Transaction ID has already been used.',
        ]);

        $cart = $this->cart();

        if (empty($cart)) {
            return redirect()->route('frontend.book.cart')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            // Lock books and make sure stock is available
            $books = Book::whereIn('id', collect($cart)->pluck('book_id'))->lockForUpdate()->get()->keyBy('id');

            foreach ($cart as $item) {
                $book = $books->get($item['book_id']);
                if (!$book || $book->stock < $item['quantity']) {
                    DB::rollBack();
                    return redirect()->route('frontend.book.cart')
                        ->with('error', '"' . $item['title'] . '" does not have enough stock.');
                }
            }

            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $books->get($item['book_id'])->final_price * $item['quantity'];
            }

            $site_setting = siteSetting();
            $delivery_charges = [
                'inside_dhaka'  => (int) ($site_setting->inside_dhaka_charge ?? 0),
                'outside_dhaka' => (int) ($site_setting->outside_dhaka_charge ?? 0),
                'suburbs'       => (int) ($site_setting->suburbs_charge ?? 0),
            ];

            $delivery_zone = $request->delivery_zone;
            $delivery_charge = $delivery_charges[$delivery_zone] ?? 0;
            $total = $subtotal + $delivery_charge;
            $is_bkash = $request->payment_method === 'bkash';

            $invoice = 'BOOK-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(5));

            // invoice_token is auto-generated by Order::booted() (creating event)
            $order = Order::create([
                'invoice'         => $invoice,
                'name'            => $request->name,
                'phone'           => $request->phone,
                'email'           => $request->email,
                'address'         => $request->address,
                'note'            => $request->note,
                'delivery_zone'   => $delivery_zone,
                'delivery_charge' => $delivery_charge,
                'total_amount'    => $total,
                'payment_method'  => $request->payment_method,
                'bkash_number'    => $is_bkash ? $request->bkash_number : null,
                'bkash_trx_id'    => $is_bkash ? $request->bkash_trx_id : null,
                'payment_status'  => 'pending',
                'stock_deducted'  => true,
                'status'          => 'pending',
            ]);

            foreach ($cart as $item) {
                $book = $books->get($item['book_id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id'  => $book->id,
                    'title'    => $book->title,
                    'original_price'   => $book->price,
                    'discount_percent' => $book->has_discount ? (int) $book->discount_percent : 0,
                    'price'    => $book->final_price,
                    'quantity' => $item['quantity'],
                    'subtotal' => $book->final_price * $item['quantity'],
                ]);

                $books->get($item['book_id'])->decrement('stock', $item['quantity']);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Book Checkout Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong! Please try again.')->withInput();
        }

        Session::forget(self::CART_KEY);

        $this->sendOrderThankYou($order);

        return redirect()->route('frontend.book.checkout.success', $order->invoice);
    }

    // Thank-you email + SMS sent immediately; failures never block the order.
    protected function sendOrderThankYou(Order $order): void
    {
        $order->load('items');

        if ($order->email) {
            try {
                Mail::to($order->email)->send(new BookOrderThankYouMail($order));
            } catch (\Throwable $e) {
                Log::error('Book order thank-you mail failed: ' . $e->getMessage());
            }
        }

        try {
            // Old orders may not have a token yet; create one on the fly
            if (empty($order->invoice_token)) {
                $order->update(['invoice_token' => Str::random(10)]);
            }

            $invoiceUrl = route('frontend.book.invoice.token', $order->invoice_token);

            $sms = sprintf(
                'Dear %s, your order is confirmed. Total: BDT %s. Invoice: %s - %s',
                Str::words($order->name, 1, ''),
                number_format($order->total_amount),
                $invoiceUrl,
                config('app.name')
            );

            app(SmsService::class)->sendSms($order->phone, $sms);
        } catch (\Throwable $e) {
            Log::error('Book order thank-you SMS failed: ' . $e->getMessage());
        }
    }

    public function CheckoutSuccess($invoice)
    {
        $order = Order::with('items')->where('invoice', $invoice)->firstOrFail();
        return view('frontend.pages.book_checkout_success', compact('order'));
    }

    public function CheckoutFailed($invoice)
    {
        $order = Order::with('items')->where('invoice', $invoice)->firstOrFail();
        return view('frontend.pages.book_checkout_failed', compact('order'));
    }

    public function DownloadInvoice($invoice)
    {
        $order = Order::with('items')
            ->where('invoice', $invoice)
            ->firstOrFail();

        $pdf = Pdf::loadView('frontend.pdf.book_order_invoice', compact('order'))->setPaper('a4', 'portrait');

        return $pdf->download($order->invoice . '.pdf');
    }

    // Short public link used in SMS: /i/{token}
    public function DownloadInvoiceByToken($token)
    {
        $order = Order::with('items')
            ->where('invoice_token', $token)
            ->firstOrFail();

        $pdf = Pdf::loadView('frontend.pdf.book_order_invoice', compact('order'))->setPaper('a4', 'portrait');

        return $pdf->download($order->invoice . '.pdf');
    }
}
