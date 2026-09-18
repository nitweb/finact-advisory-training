@extends('frontend.dashboard')
@section('frontend_title', 'Payment Failed')

@section('frontend_content')

    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Payment Failed</h3>
            </div>
        </div>
    </section>

    <section class="blog-page">
        <div class="container" style="text-align:center;">
            <i class="fas fa-times-circle" style="font-size:60px; color:#e53935;"></i>
            <h3 style="margin:20px 0 10px;">Payment Unsuccessful</h3>
            <p>Your order <strong>{{ $order->invoice }}</strong> could not be completed
                (Status: {{ ucfirst($order->payment_status) }}). Your cart items are safe — please try again.</p>

            <a href="{{ route('frontend.book.checkout') }}" class="t-btn-fill">Try Again</a>
            <a href="{{ route('frontend.book.list') }}" class="t-btn-outline">Back to Books</a>
        </div>
    </section>

@endsection
