<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Thank you for your order</title>
</head>

<body style="font-family: Arial, sans-serif; color:#2b3648; background:#f4f6f9; margin:0; padding:24px;">
    <div style="max-width:600px; margin:0 auto; background:#fff; padding:28px; border-radius:6px;">
        <h2 style="color:#163355; margin-top:0;">Thank you, {{ $order->name }}!</h2>
        <p>We have received your book order. Our team will verify it and contact you shortly.</p>

        <p><strong>Invoice:</strong> {{ $order->invoice }}<br>
            <strong>Payment:</strong> {{ $order->payment_method === 'bkash' ? 'bKash (verification pending)' : 'Cash on Delivery' }}<br>
            <strong>Delivery address:</strong> {{ $order->address }}
        </p>

        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse; font-size:14px;">
            <tr style="background:#163355; color:#fff;">
                <th align="left">Book</th>
                <th align="center">Qty</th>
                <th align="right">Subtotal</th>
            </tr>
            @foreach ($order->items as $item)
                <tr style="border-bottom:1px solid #e5e9f0;">
                    <td>{{ $item->title }}</td>
                    <td align="center">{{ $item->quantity }}</td>
                    <td align="right">৳{{ number_format($item->subtotal) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" align="right">Delivery charge</td>
                <td align="right">৳{{ number_format($order->delivery_charge ?? 0) }}</td>
            </tr>
            <tr>
                <td colspan="2" align="right"><strong>Total</strong></td>
                <td align="right"><strong>৳{{ number_format($order->total_amount) }}</strong></td>
            </tr>
        </table>

        <p style="margin-top:24px;">
            <a href="{{ route('frontend.book.invoice', $order->invoice) }}" style="background:#163355; color:#fff; padding:10px 18px; text-decoration:none; border-radius:4px;">Download Invoice</a>
        </p>

        <p style="font-size:12px; color:#8a94a6;">{{ config('app.name') }}</p>
    </div>
</body>

</html>
