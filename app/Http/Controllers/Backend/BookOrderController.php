<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BookOrderController extends Controller
{
    public function OrderList()
    {
        $title = 'Book Order List';

        $orders = Order::orderBy('id', 'asc')->get();

        return view('backend.book_order.list', compact('title', 'orders'));
    } // End Method

    public function OrderShow($id)
    {
        $title = 'Book Order Details';

        $order = Order::with('items')->findOrFail($id);

        return view('backend.book_order.show', compact('title', 'order'));
    } // End Method

    public function OrderUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        $badge = match ($order->status) {
            'completed' => 'success',
            'processing' => 'info',
            'pending' => 'warning',
            'cancelled' => 'danger',
            default => 'dark',
        };

        return response()->json([
            'success' => true,
            'status' => $order->status,
            'label' => ucfirst($order->status),
            'badge' => $badge,
        ]);
    } // End Method

    // Manual bKash verification: pending | paid | failed | cancelled
    public function OrderUpdatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,cancelled',
        ]);

        try {
            DB::transaction(function () use ($request, $id, &$order) {
                $order = Order::with('items')->lockForUpdate()->findOrFail($id);
                $new = $request->payment_status;

                if (in_array($new, ['failed', 'cancelled'])) {
                    // Give the stock back (once)
                    if ($order->stock_deducted) {
                        foreach ($order->items as $item) {
                            if ($item->book_id) {
                                Book::where('id', $item->book_id)->increment('stock', $item->quantity);
                            }
                        }
                        $order->stock_deducted = false;
                    }
                    $order->status = 'cancelled';
                } else {
                    // Re-activating a failed/cancelled order: take stock again
                    if (!$order->stock_deducted) {
                        foreach ($order->items as $item) {
                            $book = $item->book_id ? Book::lockForUpdate()->find($item->book_id) : null;
                            if ($book && $book->stock < $item->quantity) {
                                throw new \RuntimeException('Not enough stock for "' . $item->title . '".');
                            }
                        }
                        foreach ($order->items as $item) {
                            if ($item->book_id) {
                                Book::where('id', $item->book_id)->decrement('stock', $item->quantity);
                            }
                        }
                        $order->stock_deducted = true;
                    }

                    if ($order->status === 'cancelled') {
                        $order->status = 'pending';
                    }
                    if ($new === 'paid' && $order->status === 'pending') {
                        $order->status = 'processing';
                    }
                }

                $order->payment_status = $new;
                $order->save();
            });
        } catch (\RuntimeException $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }

        return response()->json([
            'success'        => true,
            'payment_status' => $order->payment_status,
            'status'         => $order->status,
            'label'          => ucfirst($order->payment_status),
        ]);
    } // End Method

    public function OrderDelete($id)
    {
        $order = Order::with('items')->findOrFail($id);

        if ($order->stock_deducted) {
            foreach ($order->items as $item) {
                if ($item->book_id) {
                    Book::where('id', $item->book_id)->increment('stock', $item->quantity);
                }
            }
        }

        $order->delete();

        return redirect()->route('admin.book.order.list')->with('success', 'Order deleted successfully.');
    } // End Method
}
