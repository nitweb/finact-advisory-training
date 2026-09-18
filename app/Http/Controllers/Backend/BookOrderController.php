<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class BookOrderController extends Controller
{
    public function OrderList()
    {
        $title = 'Book Order List';

        $orders = Order::orderBy('id', 'desc')->get();

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

    public function OrderDelete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.book.order.list')->with('success', 'Order deleted successfully.');
    } // End Method
}
