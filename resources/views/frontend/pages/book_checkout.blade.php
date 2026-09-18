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
                        <div style="margin-bottom:15px;">
                            <label>Full Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required style="width:100%; padding:10px;">
                        </div>
                        <div style="margin-bottom:15px;">
                            <label>Phone *</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required style="width:100%; padding:10px;">
                        </div>
                        <div style="margin-bottom:15px;">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" style="width:100%; padding:10px;">
                        </div>
                        <div style="margin-bottom:15px;">
                            <label>Delivery Address *</label>
                            <textarea name="address" required style="width:100%; padding:10px;">{{ old('address') }}</textarea>
                        </div>
                        <div style="margin-bottom:15px;">
                            <label>Note (optional)</label>
                            <textarea name="note" style="width:100%; padding:10px;">{{ old('note') }}</textarea>
                        </div>

                        <button type="submit" class="t-btn-fill">Pay with bKash</button>
                    </form>
                </div>

                <div class="col-lg-5">
                    <h4>Order Summary</h4>
                    <table class="table" style="width:100%; border-collapse:collapse;">
                        <tbody>
                            @foreach ($cart as $item)
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="padding:10px;">{{ $item['title'] }} x {{ $item['quantity'] }}</td>
                                    <td style="padding:10px; text-align:right;">৳ {{ number_format($item['price'] * $item['quantity']) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td style="padding:10px; font-weight:bold;">Total</td>
                                <td style="padding:10px; text-align:right; font-weight:bold;">৳ {{ number_format($total) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection
