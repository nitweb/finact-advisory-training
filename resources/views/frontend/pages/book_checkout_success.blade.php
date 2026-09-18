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
        <div class="container" style="text-align:center;">
            <i class="fas fa-check-circle" style="font-size:60px; color:#28a745;"></i>
            <h3 style="margin:20px 0 10px;">Thank you, {{ $order->name }}!</h3>
            <p>Your order <strong>{{ $order->invoice }}</strong> has been placed and payment received via bKash
                (Txn: {{ $order->bkash_trx_id }}).</p>

            <table class="table" style="width:100%; max-width:500px; margin:30px auto; border-collapse:collapse; text-align:left;">
                <tbody>
                    @foreach ($order->items as $item)
                        <tr style="border-bottom:1px solid #eee;">
                            <td style="padding:10px;">{{ $item->title }} x {{ $item->quantity }}</td>
                            <td style="padding:10px; text-align:right;">৳ {{ number_format($item->subtotal) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="padding:10px; font-weight:bold;">Total</td>
                        <td style="padding:10px; text-align:right; font-weight:bold;">৳ {{ number_format($order->total_amount) }}</td>
                    </tr>
                </tbody>
            </table>

            <a href="{{ route('frontend.book.invoice', $order->invoice) }}" class="t-btn-outline">Download Invoice</a>
            <a href="{{ route('frontend.book.list') }}" class="t-btn-fill">Continue Shopping</a>
        </div>
    </section>

@endsection
