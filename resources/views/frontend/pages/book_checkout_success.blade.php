@extends('frontend.dashboard')
@section('frontend_title', 'Order Confirmed')

@section('frontend_content')

    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Order Confirmed</h3>
            </div>
        </div>
    </section>

    <section class="blog-page">
        <div class="container">
            <div class="success-panel">
                <div class="success-panel__icon">
                    <i class="fas fa-check"></i>
                </div>
                <h3>Thank you, {{ $order->name }}!</h3>
                <p>
                    @if ($order->payment_method === 'cod')
                        Your order <span class="success-panel__invoice">{{ $order->invoice }}</span> has been placed successfully.
                        You'll pay <strong>৳ {{ number_format($order->total_amount) }}</strong> in cash when it's delivered.
                    @else
                        Your order <span class="success-panel__invoice">{{ $order->invoice }}</span> has been placed and
                        your bKash payment (Txn: {{ $order->bkash_trx_id }}) is being verified. We'll confirm your order shortly.
                    @endif
                </p>

                <table>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->title }} x {{ $item->quantity }}</td>
                                <td style="text-align:right;">৳ {{ number_format($item->subtotal) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Delivery Charge ({{ ucfirst(str_replace('_', ' ', $order->delivery_zone)) }})</td>
                            <td style="text-align:right;">৳ {{ number_format($order->delivery_charge) }}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td style="text-align:right;">৳ {{ number_format($order->total_amount) }}</td>
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            <td style="text-align:right;">
                                @if (strtolower($order->payment_method ?? '') === 'cod')
                                    Cash on Delivery
                                @elseif (strtolower($order->payment_method ?? '') === 'bkash')
                                    bKash
                                @else
                                    {{ strtoupper($order->payment_method ?? 'N/A') }}
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="success-panel__actions">
                    <a href="{{ route('frontend.book.invoice', $order->invoice) }}" class="t-btn-outline">
                        <i class="fas fa-download"></i> Download Invoice
                    </a>
                    <a href="{{ route('frontend.book.list') }}" class="t-btn-fill">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
