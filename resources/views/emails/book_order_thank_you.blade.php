<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed</title>
</head>

<body style="margin:0; padding:0; background:#eef1f6; font-family:'Segoe UI', Arial, Helvetica, sans-serif; color:#2b3648;">

    {{-- Preheader (inbox preview text) --}}
    <div style="display:none; max-height:0; overflow:hidden; opacity:0; font-size:1px; line-height:1px; color:#eef1f6;">
        Order {{ $order->invoice }} confirmed. Total: ৳{{ number_format($order->total_amount) }}.
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#eef1f6; padding:24px 12px;">
        <tr>
            <td align="center">

                <table role="presentation" width="600" cellpadding="0" cellspacing="0"
                    style="width:100%; max-width:600px; background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 2px 8px rgba(22,51,85,0.08);">

                    {{-- Header --}}
                    <tr>
                        <td align="center" style="background:#163355; padding:26px 24px;">
                            <div style="color:#ffffff; font-size:22px; font-weight:700; letter-spacing:0.5px;">
                                {{ config('app.name') }}
                            </div>
                            <div style="color:#b9c7dc; font-size:13px; margin-top:4px;">Order Confirmation</div>
                        </td>
                    </tr>

                    {{-- Heading & intro --}}
                    <tr>
                        <td style="padding:32px 32px 8px;">
                            <h2 style="margin:0 0 12px; font-size:22px; color:#163355;">
                                Your order is confirmed
                            </h2>
                            <p style="margin:0 0 10px; font-size:15px; line-height:1.6; color:#2b3648;">
                                Dear {{ $order->name }},
                            </p>
                            <p style="margin:0; font-size:15px; line-height:1.6; color:#4a5568;">
                                Thank you for choosing {{ config('app.name') }}. We have received your book order,
                                and our team will verify it and contact you shortly.
                            </p>
                        </td>
                    </tr>

                    {{-- Order info card --}}
                    <tr>
                        <td style="padding:20px 32px 8px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                style="background:#f7f9fc; border:1px solid #e3e8f0; border-radius:8px;">
                                <tr>
                                    <td style="padding:16px 18px; font-size:14px; line-height:1.9;">
                                        <span style="color:#7a8599;">Invoice No.</span><br>
                                        <strong style="color:#163355; font-size:16px;">{{ $order->invoice }}</strong>
                                    </td>
                                    <td style="padding:16px 18px; font-size:14px; line-height:1.9;" align="right">
                                        <span style="color:#7a8599;">Payment Method</span><br>
                                        <strong style="color:#163355;">
                                            {{ $order->payment_method === 'bkash' ? 'bKash (verification pending)' : 'Cash on Delivery' }}
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding:0 18px 16px; font-size:14px; line-height:1.6;">
                                        <span style="color:#7a8599;">Delivery Address</span><br>
                                        <span style="color:#2b3648;">{{ $order->address }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Order summary --}}
                    <tr>
                        <td style="padding:20px 32px 0;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                style="border-collapse:collapse; font-size:14px;">
                                <tr>
                                    <th align="left" style="padding:10px 0; border-bottom:2px solid #163355; color:#163355; font-size:12px; text-transform:uppercase; letter-spacing:0.6px;">Book</th>
                                    <th align="center" style="padding:10px 0; border-bottom:2px solid #163355; color:#163355; font-size:12px; text-transform:uppercase; letter-spacing:0.6px;">Qty</th>
                                    <th align="right" style="padding:10px 0; border-bottom:2px solid #163355; color:#163355; font-size:12px; text-transform:uppercase; letter-spacing:0.6px;">Subtotal</th>
                                </tr>

                                @foreach ($order->items as $item)
                                    <tr>
                                        <td style="padding:12px 0; border-bottom:1px solid #e9edf3; color:#2b3648;">{{ $item->title }}</td>
                                        <td align="center" style="padding:12px 0; border-bottom:1px solid #e9edf3; color:#4a5568;">{{ $item->quantity }}</td>
                                        <td align="right" style="padding:12px 0; border-bottom:1px solid #e9edf3; color:#2b3648;">৳{{ number_format($item->subtotal) }}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="2" align="right" style="padding:12px 0 4px; color:#7a8599;">Delivery Charge</td>
                                    <td align="right" style="padding:12px 0 4px; color:#2b3648;">৳{{ number_format($order->delivery_charge ?? 0) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right" style="padding:8px 0; font-size:16px; color:#163355;"><strong>Total</strong></td>
                                    <td align="right" style="padding:8px 0; font-size:18px; color:#163355;"><strong>৳{{ number_format($order->total_amount) }}</strong></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- CTA --}}
                    <tr>
                        <td align="center" style="padding:28px 32px 8px;">
                            <table role="presentation" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="background:#163355; border-radius:6px;">
                                        <a href="{{ $invoiceUrl }}" target="_blank"
                                            style="display:inline-block; padding:13px 30px; color:#ffffff; font-size:15px; font-weight:600; text-decoration:none;">
                                            View Invoice
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <p style="margin:14px 0 0; font-size:13px; color:#7a8599;">
                                A PDF copy of your invoice is attached to this email.
                            </p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:28px 32px 30px;">
                            <hr style="border:none; border-top:1px solid #e9edf3; margin:0 0 18px;">
                            <p style="margin:0; font-size:13px; line-height:1.6; color:#7a8599; text-align:center;">
                                If you have any questions about your order, please contact our support team.
                            </p>
                            <p style="margin:10px 0 0; font-size:12px; color:#9aa4b5; text-align:center;">
                                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>