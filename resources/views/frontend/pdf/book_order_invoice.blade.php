<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 13px; color: #1f2937; padding: 40px; }
        .header { text-align: center; border-bottom: 2px solid #163355; padding-bottom: 18px; margin-bottom: 24px; }
        .header h1 { font-size: 22px; color: #163355; margin-bottom: 4px; }
        .invoice-num { display: inline-block; border: 1px solid #163355; color: #163355; font-size: 12px; font-weight: bold; padding: 3px 14px; border-radius: 4px; margin-top: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px 10px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        th { background: #f0f4f9; color: #163355; }
        .total-row td { font-weight: bold; border-top: 2px solid #163355; }
        .info { margin-top: 20px; }
        .info p { margin-bottom: 4px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Book Order Invoice</h1>
        <p>{{ config('app.name') }}</p>
        <div class="invoice-num">{{ $order->invoice }}</div>
    </div>

    <div class="info">
        <p><strong>Name:</strong> {{ $order->name }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        @if ($order->email)
            <p><strong>Email:</strong> {{ $order->email }}</p>
        @endif
        <p><strong>Address:</strong> {{ $order->address }}</p>
        <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
        <p><strong>bKash Transaction ID:</strong> {{ $order->bkash_trx_id }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Book</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>৳ {{ number_format($item->price) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>৳ {{ number_format($item->subtotal) }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3">Total</td>
                <td>৳ {{ number_format($order->total_amount) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
