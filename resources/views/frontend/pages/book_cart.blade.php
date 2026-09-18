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
                        <tbody id="cart-items-body">
                            @foreach ($cart as $id => $item)
                                <tr data-book-id="{{ $id }}" data-price="{{ $item['price'] }}">
                                    <td data-label="Book"><span class="cart-item__title">{{ $item['title'] }}</span></td>
                                    <td data-label="Price"><span class="cart-item__price">৳ {{ number_format($item['price']) }}</span></td>
                                    <td data-label="Quantity">
                                        <form action="{{ route('frontend.book.cart.update', $id) }}" method="POST" class="cart-qty-form" data-ajax-url="{{ route('frontend.book.cart.update.ajax', $id) }}">
                                            @csrf
                                            <div class="cart-qty-stepper">
                                                <button type="button" class="cart-qty-btn cart-qty-minus" aria-label="Decrease quantity">&minus;</button>
                                                <input type="number" name="quantity" class="cart-qty-input" value="{{ $item['quantity'] }}" min="1">
                                                <button type="button" class="cart-qty-btn cart-qty-plus" aria-label="Increase quantity">&plus;</button>
                                            </div>
                                            <button type="submit" class="cart-btn-mini" style="display:none;">Update</button>
                                        </form>
                                        <span class="cart-qty-note text-muted" style="display:none; font-size:12px;"></span>
                                    </td>
                                    <td data-label="Subtotal"><span class="cart-item__subtotal">৳ <span class="cart-item__subtotal-value">{{ number_format($item['price'] * $item['quantity']) }}</span></span></td>
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
                            <strong id="cart-total-value">৳ {{ number_format($total) }}</strong>
                        </div>
                        <a href="{{ route('frontend.book.checkout') }}" class="t-btn-fill" style="flex:none; padding:13px 34px; display:inline-flex; align-items:center; gap:8px;">
                            Proceed to Checkout <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </section>

    <style>
        .cart-qty-stepper { display: inline-flex; align-items: center; border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; }
        .cart-qty-stepper .cart-qty-btn { width: 32px; height: 32px; border: none; background: #f3f4f6; cursor: pointer; font-size: 16px; line-height: 1; }
        .cart-qty-stepper .cart-qty-btn:hover { background: #e5e7eb; }
        .cart-qty-stepper .cart-qty-input { width: 50px; height: 32px; text-align: center; border: none; border-left: 1px solid #e5e7eb; border-right: 1px solid #e5e7eb; -moz-appearance: textfield; }
        .cart-qty-stepper .cart-qty-input::-webkit-outer-spin-button,
        .cart-qty-stepper .cart-qty-input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        tr.cart-row-updating { opacity: 0.55; pointer-events: none; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var csrfToken = '{{ csrf_token() }}';
            var cartBody = document.getElementById('cart-items-body');
            var cartTotalEl = document.getElementById('cart-total-value');

            if (!cartBody) return;

            function formatNumber(n) {
                return Number(n).toLocaleString('en-US');
            }

            function updateBadges(cartCount) {
                document.querySelectorAll('.book-cart-btn__badge').forEach(function (el) {
                    el.textContent = cartCount;
                    el.style.display = cartCount > 0 ? '' : 'none';
                });
            }

            var debounceTimers = {};

            function submitQtyUpdate(row, input) {
                var bookId = row.getAttribute('data-book-id');
                var form = row.querySelector('.cart-qty-form');
                var url = form.getAttribute('data-ajax-url');
                var note = row.querySelector('.cart-qty-note');

                var qty = parseInt(input.value, 10);
                if (isNaN(qty) || qty < 1) {
                    qty = 1;
                    input.value = 1;
                }

                row.classList.add('cart-row-updating');

                var body = new URLSearchParams();
                body.set('_token', csrfToken);
                body.set('quantity', qty);

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Accept': 'application/json'
                    },
                    body: body.toString()
                })
                    .then(function (res) {
                        return res.json().then(function (data) {
                            return { ok: res.ok, data: data };
                        });
                    })
                    .then(function (result) {
                        var data = result.data;

                        if (!result.ok || !data.success) {
                            var msg = data.message || 'Unable to update quantity.';
                            if (note) { note.textContent = msg; note.style.display = ''; }
                            return;
                        }

                        input.value = data.quantity;
                        var subtotalEl = row.querySelector('.cart-item__subtotal-value');
                        if (subtotalEl) subtotalEl.textContent = formatNumber(data.item_subtotal);
                        if (cartTotalEl) cartTotalEl.textContent = '৳ ' + formatNumber(data.cart_total);
                        updateBadges(data.cart_count);

                        if (note) {
                            if (data.note) {
                                note.textContent = data.note;
                                note.style.display = '';
                            } else {
                                note.style.display = 'none';
                            }
                        }
                    })
                    .catch(function () {
                        if (note) {
                            note.textContent = 'Something went wrong while updating quantity.';
                            note.style.display = '';
                        }
                    })
                    .finally(function () {
                        row.classList.remove('cart-row-updating');
                    });
            }

            function debouncedUpdate(row, input) {
                var bookId = row.getAttribute('data-book-id');
                clearTimeout(debounceTimers[bookId]);
                debounceTimers[bookId] = setTimeout(function () {
                    submitQtyUpdate(row, input);
                }, 300);
            }

            cartBody.addEventListener('change', function (e) {
                if (!e.target.classList.contains('cart-qty-input')) return;
                var row = e.target.closest('tr');
                debouncedUpdate(row, e.target);
            });

            cartBody.addEventListener('click', function (e) {
                var btn = e.target.closest('.cart-qty-btn');
                if (!btn) return;

                var row = btn.closest('tr');
                var input = row.querySelector('.cart-qty-input');
                var qty = parseInt(input.value, 10);
                if (isNaN(qty)) qty = 1;

                if (btn.classList.contains('cart-qty-plus')) {
                    qty += 1;
                } else if (btn.classList.contains('cart-qty-minus')) {
                    qty = Math.max(1, qty - 1);
                }

                input.value = qty;
                debouncedUpdate(row, input);
            });

            cartBody.addEventListener('submit', function (e) {
                if (!e.target.classList.contains('cart-qty-form')) return;
                e.preventDefault();
                var row = e.target.closest('tr');
                submitQtyUpdate(row, row.querySelector('.cart-qty-input'));
            });
        });
    </script>

@endsection