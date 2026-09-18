@extends('frontend.dashboard')
@section('frontend_title', 'Your Cart')

@section('frontend_content')

    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Your Cart</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li><a href="{{ route('frontend.book.list') }}">Books</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-page">
        <div class="container">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if (empty($cart))
                <p>Your cart is empty. <a href="{{ route('frontend.book.list') }}">Browse books</a>.</p>
            @else
                <table class="table" style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr style="text-align:left; border-bottom:2px solid #eee;">
                            <th style="padding:10px;">Book</th>
                            <th style="padding:10px;">Price</th>
                            <th style="padding:10px;">Quantity</th>
                            <th style="padding:10px;">Subtotal</th>
                            <th style="padding:10px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $id => $item)
                            <tr style="border-bottom:1px solid #eee;">
                                <td style="padding:10px;">{{ $item['title'] }}</td>
                                <td style="padding:10px;">৳ {{ number_format($item['price']) }}</td>
                                <td style="padding:10px;">
                                    <form action="{{ route('frontend.book.cart.update', $id) }}" method="POST" style="display:flex; gap:8px;">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width:70px; padding:6px;">
                                        <button type="submit" class="t-btn-outline" style="padding:6px 12px;">Update</button>
                                    </form>
                                </td>
                                <td style="padding:10px;">৳ {{ number_format($item['price'] * $item['quantity']) }}</td>
                                <td style="padding:10px;">
                                    <a href="{{ route('frontend.book.cart.remove', $id) }}" class="t-btn-outline" style="color:#e53935; border-color:#e53935;">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="text-align:right; margin-top:20px;">
                    <h4>Total: ৳ {{ number_format($total) }}</h4>
                    <a href="{{ route('frontend.book.checkout') }}" class="t-btn-fill">Proceed to Checkout</a>
                </div>
            @endif

        </div>
    </section>

@endsection
