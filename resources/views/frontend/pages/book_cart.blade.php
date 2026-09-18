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
                <div class="cart-empty">
                    <i class="fas fa-shopping-cart"></i>
                    <p>Your cart is empty.</p>
                    <a href="{{ route('frontend.book.list') }}" class="t-btn-fill" style="flex:none; padding:12px 28px; display:inline-block;">Browse Books</a>
                </div>
            @else
                <div class="cart-panel">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Book</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $item)
                                <tr>
                                    <td data-label="Book"><span class="cart-item__title">{{ $item['title'] }}</span></td>
                                    <td data-label="Price"><span class="cart-item__price">৳ {{ number_format($item['price']) }}</span></td>
                                    <td data-label="Quantity">
                                        <form action="{{ route('frontend.book.cart.update', $id) }}" method="POST" class="cart-qty-form">
                                            @csrf
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                                            <button type="submit" class="cart-btn-mini">Update</button>
                                        </form>
                                    </td>
                                    <td data-label="Subtotal"><span class="cart-item__subtotal">৳ {{ number_format($item['price'] * $item['quantity']) }}</span></td>
                                    <td data-label="">
                                        <a href="{{ route('frontend.book.cart.remove', $id) }}" class="cart-remove-btn" title="Remove">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="cart-summary">
                        <div class="cart-summary__total">
                            <span>Total Amount</span>
                            <strong>৳ {{ number_format($total) }}</strong>
                        </div>
                        <a href="{{ route('frontend.book.checkout') }}" class="t-btn-fill" style="flex:none; padding:13px 34px; display:inline-flex; align-items:center; gap:8px;">
                            Proceed to Checkout <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </section>

@endsection