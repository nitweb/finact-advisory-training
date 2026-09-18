<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\BkashService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

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

    // ── Cart (session based) ──
    protected function cart(): array
    {
        return Session::get(self::CART_KEY, []);
    }

    public function CartAdd(Request $request, $id)
    {
        $book = Book::where('status', 'active')->findOrFail($id);
        $qty = max(1, (int) $request->input('quantity', 1));

        $cart = $this->cart();

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                'book_id'  => $book->id,
                'title'    => $book->title,
                'price'    => $book->price,
                'cover'    => $book->cover_image,
                'quantity' => $qty,
            ];
        }

        // Don't allow more than available stock
        if ($cart[$id]['quantity'] > $book->stock) {
            $cart[$id]['quantity'] = $book->stock;
        }

        Session::put(self::CART_KEY, $cart);

        return redirect()->route('frontend.book.cart')->with('success', 'Book added to cart.');
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
            if ($book && $qty > $book->stock) {
                $qty = $book->stock;
            }
            $cart[$id]['quantity'] = $qty;
            Session::put(self::CART_KEY, $cart);
        }

        return redirect()->route('frontend.book.cart');
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

        return view('frontend.pages.book_checkout', compact('cart', 'total'));
    }

    // Creates a pending Order, then redirects to bKash payment page
    public function CheckoutSubmit(Request $request, BkashService $bkash)
    {
        $request->validate([
            'name'    => 'required|string|max:120',
            'phone'   => 'required|string|max:30',
            'email'   => 'nullable|email|max:120',
            'address' => 'required|string|max:255',
            'note'    => 'nullable|string|max:500',
        ]);

        $cart = $this->cart();

        if (empty($cart)) {
            return redirect()->route('frontend.book.cart')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $invoice = 'BOOK-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(5));

            $order = Order::create([
                'invoice'        => $invoice,
                'name'           => $request->name,
                'phone'          => $request->phone,
                'email'          => $request->email,
                'address'        => $request->address,
                'note'           => $request->note,
                'total_amount'   => $total,
                'payment_status' => 'pending',
                'status'         => 'pending',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id'  => $item['book_id'],
                    'title'    => $item['title'],
                    'price'    => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Book Checkout Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong! Please try again.')->withInput();
        }

        // Kick off bKash Tokenized Checkout
        $callbackURL = route('frontend.book.bkash.callback');
        $payment = $bkash->createPayment($invoice, $total, $callbackURL);

        if (!$payment || !isset($payment['paymentID']) || !isset($payment['bkashURL'])) {
            $order->update(['payment_status' => 'failed']);
            Log::error('Bkash Create Payment Response: ' . json_encode($payment));
            return redirect()->route('frontend.book.checkout.failed', $order->invoice)
                ->with('error', 'Unable to initiate bKash payment. Please try again.');
        }

        $order->update(['bkash_payment_id' => $payment['paymentID']]);

        return redirect()->away($payment['bkashURL']);
    }

    // bKash redirects here after user completes/cancels payment on their end
    public function BkashCallback(Request $request, BkashService $bkash)
    {
        $paymentID = $request->query('paymentID');
        $status = $request->query('status'); // success | failure | cancel

        $order = Order::where('bkash_payment_id', $paymentID)->first();

        if (!$order) {
            return redirect()->route('frontend.book.list')->with('error', 'Order not found.');
        }

        if ($status !== 'success') {
            $order->update(['payment_status' => $status === 'cancel' ? 'cancelled' : 'failed']);
            return redirect()->route('frontend.book.checkout.failed', $order->invoice);
        }

        $result = $bkash->executePayment($paymentID);

        if (!$result || ($result['transactionStatus'] ?? null) !== 'Completed') {
            $order->update(['payment_status' => 'failed']);
            Log::error('Bkash Execute Payment Response: ' . json_encode($result));
            return redirect()->route('frontend.book.checkout.failed', $order->invoice);
        }

        // Reduce stock now that payment is confirmed
        foreach ($order->items as $item) {
            if ($item->book_id) {
                $book = Book::find($item->book_id);
                if ($book) {
                    $book->decrement('stock', min($item->quantity, $book->stock));
                }
            }
        }

        $order->update([
            'bkash_trx_id'   => $result['trxID'] ?? null,
            'payment_status' => 'paid',
            'status'         => 'processing',
        ]);

        // Clear cart
        Session::forget(self::CART_KEY);

        return redirect()->route('frontend.book.checkout.success', $order->invoice);
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
        $order = Order::with('items')->where('invoice', $invoice)->where('payment_status', 'paid')->firstOrFail();

        $pdf = Pdf::loadView('frontend.pdf.book_order_invoice', compact('order'))->setPaper('a4', 'portrait');

        return $pdf->download($order->invoice . '.pdf');
    }
}
