@extends('frontend.dashboard')
@section('frontend_title', 'Checkout')

@section('frontend_content')

    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Checkout</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li><a href="{{ route('frontend.book.cart') }}">Cart</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="checkout-panel">
                        <h4>Delivery Information</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul style="margin-bottom:0;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('frontend.book.checkout.submit') }}" method="POST">
                            @csrf
                            <div class="checkout-field">
                                <label>Full Name *</label>
                                <input type="text" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="checkout-field">
                                <label>Phone *</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" required>
                            </div>
                            <div class="checkout-field">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="checkout-field">
                                <label>Delivery Address *</label>
                                <textarea name="address" required>{{ old('address') }}</textarea>
                            </div>
                            <div class="checkout-field">
                                <label>Note (optional)</label>
                                <textarea name="note">{{ old('note') }}</textarea>
                            </div>

                            <button type="submit" class="checkout-pay-btn">
                                <i class="fas fa-mobile-alt"></i> Pay with bKash
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="checkout-summary">
                        <h4>Order Summary</h4>
                        @foreach ($cart as $item)
                            <div class="checkout-summary__item">
                                <span class="checkout-summary__item-title">{{ $item['title'] }} <span style="color:#9ca3af;">x{{ $item['quantity'] }}</span></span>
                                <span class="checkout-summary__item-price">৳ {{ number_format($item['price'] * $item['quantity']) }}</span>
                            </div>
                        @endforeach
                        <div class="checkout-summary__total">
                            <span>Total</span>
                            <strong>৳ {{ number_format($total) }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection