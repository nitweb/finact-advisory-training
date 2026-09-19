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
                @php $itemCount = collect($cart)->sum('quantity'); @endphp

                <div class="cartx">

                    {{-- Top bar: Continue Shopping at the start --}}
                    <div class="cartx-top">
                        <a href="{{ route('frontend.book.list') }}" class="cartx-back">
                            <span class="cartx-back__icon"><i class="fas fa-arrow-left"></i></span>
                            <span>Continue Shopping</span>
                        </a>
                        <div class="cartx-heading">
                            <h4>Shopping Cart</h4>
                            <span class="cartx-count"><span id="cart-count">{{ $itemCount }}</span> {{ $itemCount == 1 ? 'item' : 'items' }}</span>
                        </div>
                    </div>

                    <div class="cartx-grid">

                        {{-- Items --}}
                        <div class="cartx-items" id="cart-items-body">
                            @foreach ($cart as $id => $item)
                                <div class="cartx-item" data-book-id="{{ $id }}" data-price="{{ $item['price'] }}">

                                    <div class="cartx-item__cover">
                                        <img src="{{ !empty($item['cover']) ? asset($item['cover']) : asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }}" alt="{{ $item['title'] }}">
                                    </div>

                                    <div class="cartx-item__info">
                                        <span class="cartx-item__tag"><i class="fas fa-book-open"></i> Book</span>
                                        <h5 class="cartx-item__title">{{ $item['title'] }}</h5>
                                        <span class="cartx-item__unit">
                                            @if (($item['discount_percent'] ?? 0) > 0)
                                                <del style="opacity:.6;">৳ {{ number_format($item['original_price']) }}</del>
                                            @endif
                                            ৳ {{ number_format($item['price']) }}
                                            @if (($item['discount_percent'] ?? 0) > 0)
                                                <small style="color:#dc3545;font-weight:600;">({{ $item['discount_percent'] }}% OFF)</small>
                                            @endif
                                            <small>per copy</small>
                                        </span>
                                    </div>

                                    <div class="cartx-item__qty">
                                        <form action="{{ route('frontend.book.cart.update', $id) }}" method="POST" class="cart-qty-form" data-ajax-url="{{ route('frontend.book.cart.update.ajax', $id) }}">
                                            @csrf
                                            <div class="cart-qty-stepper">
                                                <button type="button" class="cart-qty-btn cart-qty-minus" aria-label="Decrease quantity">&minus;</button>
                                                <input type="number" name="quantity" class="cart-qty-input" value="{{ $item['quantity'] }}" min="1">
                                                <button type="button" class="cart-qty-btn cart-qty-plus" aria-label="Increase quantity">&plus;</button>
                                            </div>
                                            <button type="submit" style="display:none;">Update</button>
                                        </form>
                                        <span class="cart-qty-note" style="display:none;"></span>
                                    </div>

                                    <div class="cartx-item__subtotal">
                                        <span class="cartx-item__subtotal-label">Subtotal</span>
                                        <strong>৳ <span class="cart-item__subtotal-value">{{ number_format($item['price'] * $item['quantity']) }}</span></strong>
                                    </div>

                                    <a href="{{ route('frontend.book.cart.remove', $id) }}" class="cartx-item__remove" title="Remove item" aria-label="Remove item">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        {{-- Summary --}}
                        <aside class="cartx-summary">
                            <h4>Order Summary</h4>

                            <div class="cartx-summary__row">
                                <span>Subtotal</span>
                                <span>৳ <span id="cart-subtotal-value">{{ number_format($total) }}</span></span>
                            </div>
                            <div class="cartx-summary__row">
                                <span>Delivery</span>
                                <span class="cartx-summary__muted">Calculated at checkout</span>
                            </div>

                            <div class="cartx-summary__total">
                                <span>Total Amount</span>
                                <strong id="cart-total-value">৳ {{ number_format($total) }}</strong>
                            </div>

                            <a href="{{ route('frontend.book.checkout') }}" class="cartx-checkout">
                                Proceed to Checkout <i class="fas fa-arrow-right"></i>
                            </a>

                            <ul class="cartx-trust">
                                <li><i class="fas fa-lock"></i> Safe &amp; secure checkout</li>
                                <li><i class="fas fa-mobile-screen-button"></i> bKash &amp; Cash on Delivery</li>
                                <li><i class="fas fa-truck-fast"></i> Nationwide delivery</li>
                            </ul>
                        </aside>

                    </div>
                </div>
            @endif

        </div>
    </section>

    <style>
        .cartx {
            --cx-navy: #163355;
            --cx-navy-dark: #0e2240;
            --cx-gold: #b89867;
            --cx-gold-dark: #9a7d4e;
        }

        /* ── Top bar ── */
        .cartx-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 26px;
        }

        .cartx-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 6px 20px 6px 6px;
            background: #fff;
            border: 1.5px solid #e3e8f1;
            border-radius: 50px;
            color: var(--cx-navy);
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(22, 51, 85, .06);
            transition: all .25s ease;
        }

        .cartx-back__icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--cx-navy);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            transition: all .25s ease;
        }

        .cartx-back:hover {
            border-color: var(--cx-gold);
            color: var(--cx-gold-dark);
            transform: translateX(-3px);
            text-decoration: none;
        }

        .cartx-back:hover .cartx-back__icon {
            background: var(--cx-gold);
        }

        .cartx-heading {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .cartx-heading h4 {
            margin: 0;
            font-size: 22px;
            font-weight: 800;
            color: var(--cx-navy);
        }

        .cartx-count {
            background: rgba(184, 152, 103, .15);
            color: var(--cx-gold-dark);
            font-size: 12px;
            font-weight: 700;
            padding: 5px 13px;
            border-radius: 50px;
        }

        /* ── Layout ── */
        .cartx-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 350px;
            gap: 28px;
            align-items: start;
        }

        /* ── Item card ── */
        .cartx-items {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .cartx-item {
            position: relative;
            display: grid;
            grid-template-columns: 84px minmax(0, 1fr) auto auto 38px;
            align-items: center;
            gap: 22px;
            padding: 16px 20px 16px 16px;
            background: #fff;
            border: 1px solid #eef1f6;
            border-left: 4px solid var(--cx-gold);
            border-radius: 14px;
            box-shadow: 0 6px 22px rgba(22, 51, 85, .07);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .cartx-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 32px rgba(22, 51, 85, .13);
        }

        .cartx-item.cart-row-updating {
            opacity: .55;
            pointer-events: none;
        }

        .cartx-item__cover {
            width: 84px;
            height: 112px;
            border-radius: 8px;
            overflow: hidden;
            background: #f1f3f8;
            box-shadow: 4px 6px 14px rgba(22, 51, 85, .22);
        }

        .cartx-item__cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .cartx-item__tag {
            display: inline-block;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--cx-gold-dark);
            margin-bottom: 6px;
        }

        .cartx-item__title {
            margin: 0 0 6px;
            font-size: 16.5px;
            font-weight: 800;
            line-height: 1.35;
            color: var(--cx-navy);
        }

        .cartx-item__unit {
            font-size: 14px;
            font-weight: 600;
            color: #6b7280;
        }

        .cartx-item__unit small {
            font-size: 11.5px;
            color: #9aa3b2;
            font-weight: 500;
        }

        .cartx-item__qty {
            text-align: center;
        }

        .cart-qty-stepper {
            display: inline-flex;
            align-items: center;
            background: #f5f7fb;
            border: 1.5px solid #e3e8f1;
            border-radius: 50px;
            padding: 3px;
        }

        .cart-qty-stepper .cart-qty-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 50%;
            background: #fff;
            color: var(--cx-navy);
            cursor: pointer;
            font-size: 17px;
            font-weight: 700;
            line-height: 1;
            box-shadow: 0 2px 6px rgba(22, 51, 85, .12);
            transition: all .2s ease;
        }

        .cart-qty-stepper .cart-qty-btn:hover {
            background: var(--cx-gold);
            color: #fff;
        }

        .cart-qty-stepper .cart-qty-input {
            width: 44px;
            height: 32px;
            text-align: center;
            border: none;
            background: transparent;
            font-size: 15px;
            font-weight: 800;
            color: var(--cx-navy);
            -moz-appearance: textfield;
            outline: none;
            padding: 0;
        }

        .cart-qty-stepper .cart-qty-input::-webkit-outer-spin-button,
        .cart-qty-stepper .cart-qty-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .cart-qty-note {
            display: block;
            margin-top: 6px;
            font-size: 11.5px;
            color: #c0392b;
            max-width: 150px;
        }

        .cartx-item__subtotal {
            text-align: right;
            min-width: 92px;
        }

        .cartx-item__subtotal-label {
            display: block;
            font-size: 10.5px;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: #9aa3b2;
            margin-bottom: 3px;
        }

        .cartx-item__subtotal strong {
            font-size: 18px;
            font-weight: 800;
            color: var(--cx-navy);
        }

        .cartx-item__remove {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff5f5;
            color: #e05555;
            font-size: 14px;
            text-decoration: none;
            transition: all .2s ease;
        }

        .cartx-item__remove:hover {
            background: #e05555;
            color: #fff;
            transform: rotate(8deg) scale(1.08);
            text-decoration: none;
        }

        /* ── Summary ── */
        .cartx-summary {
            position: sticky;
            top: 100px;
            padding: 28px 26px;
            border-radius: 18px;
            color: #fff;
            background: linear-gradient(160deg, #163355 0%, #0e2240 100%);
            box-shadow: 0 18px 44px rgba(14, 34, 64, .35);
            overflow: hidden;
        }

        .cartx-summary::before {
            content: '';
            position: absolute;
            top: -70px;
            right: -70px;
            width: 190px;
            height: 190px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(184, 152, 103, .38), transparent 70%);
        }

        .cartx-summary>* {
            position: relative;
        }

        .cartx-summary h4 {
            margin: 0 0 20px;
            padding-bottom: 16px;
            font-size: 17px;
            font-weight: 800;
            color: #fff;
            border-bottom: 1px solid rgba(255, 255, 255, .14);
        }

        .cartx-summary__row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            font-size: 14px;
            color: rgba(255, 255, 255, .78);
        }

        .cartx-summary__muted {
            font-size: 12px;
            color: var(--cx-gold);
        }

        .cartx-summary__total {
            margin: 20px 0 22px;
            padding: 16px 0 0;
            border-top: 1px dashed rgba(255, 255, 255, .25);
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .cartx-summary__total span {
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: rgba(255, 255, 255, .65);
        }

        .cartx-summary__total strong {
            font-size: 30px;
            font-weight: 800;
            line-height: 1;
            color: #fff;
        }

        .cartx-checkout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 15px 20px;
            border-radius: 12px;
            background: linear-gradient(135deg, #b89867 0%, #d4b896 100%);
            color: #0e2240;
            font-size: 14.5px;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 10px 24px rgba(184, 152, 103, .4);
            transition: all .25s ease;
        }

        .cartx-checkout i {
            transition: transform .25s ease;
        }

        .cartx-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(184, 152, 103, .55);
            color: #0e2240;
            text-decoration: none;
        }

        .cartx-checkout:hover i {
            transform: translateX(5px);
        }

        .cartx-trust {
            list-style: none;
            margin: 22px 0 0;
            padding: 18px 0 0;
            border-top: 1px solid rgba(255, 255, 255, .14);
        }

        .cartx-trust li {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 9px;
            font-size: 12.5px;
            color: rgba(255, 255, 255, .75);
        }

        .cartx-trust li:last-child {
            margin-bottom: 0;
        }

        .cartx-trust i {
            width: 16px;
            text-align: center;
            color: var(--cx-gold);
        }

        /* ── Responsive ── */
        @media (max-width: 991px) {
            .cartx-grid {
                grid-template-columns: 1fr;
            }

            .cartx-summary {
                position: static;
            }
        }

        @media (max-width: 640px) {
            .cartx-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .cartx-item {
                grid-template-columns: 72px minmax(0, 1fr) 38px;
                gap: 14px;
                padding: 14px;
            }

            .cartx-item__cover {
                width: 72px;
                height: 96px;
                grid-row: span 2;
            }

            .cartx-item__remove {
                grid-column: 3;
                grid-row: 1;
            }

            .cartx-item__qty {
                grid-column: 2;
                text-align: left;
            }

            .cartx-item__subtotal {
                grid-column: 3 / -1;
                grid-column: 2 / -1;
                text-align: left;
                display: flex;
                align-items: baseline;
                gap: 8px;
            }

            .cartx-item__subtotal-label {
                margin: 0;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var csrfToken = '{{ csrf_token() }}';
            var cartBody = document.getElementById('cart-items-body');
            var cartTotalEl = document.getElementById('cart-total-value');
            var cartSubtotalEl = document.getElementById('cart-subtotal-value');
            var cartCountEl = document.getElementById('cart-count');

            if (!cartBody) return;

            function formatNumber(n) {
                return Number(n).toLocaleString('en-US');
            }

            function updateBadges(cartCount) {
                document.querySelectorAll('.book-cart-btn__badge').forEach(function(el) {
                    el.textContent = cartCount;
                    el.style.display = cartCount > 0 ? '' : 'none';
                });
                document.querySelectorAll('.header-cart-count').forEach(function(el) {
                    el.textContent = cartCount;
                });
                if (cartCountEl) {
                    cartCountEl.textContent = cartCount;
                    var label = cartCountEl.parentNode.lastChild;
                    if (label && label.nodeType === 3) {
                        label.textContent = cartCount == 1 ? ' item' : ' items';
                    }
                }
            }

            var debounceTimers = {};

            function submitQtyUpdate(row, input) {
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
                    .then(function(res) {
                        return res.json().then(function(data) {
                            return {
                                ok: res.ok,
                                data: data
                            };
                        });
                    })
                    .then(function(result) {
                        var data = result.data;

                        if (!result.ok || !data.success) {
                            var msg = data.message || 'Unable to update quantity.';
                            if (note) {
                                note.textContent = msg;
                                note.style.display = '';
                            }
                            return;
                        }

                        input.value = data.quantity;
                        var subtotalEl = row.querySelector('.cart-item__subtotal-value');
                        if (subtotalEl) subtotalEl.textContent = formatNumber(data.item_subtotal);
                        if (cartTotalEl) cartTotalEl.textContent = '৳ ' + formatNumber(data.cart_total);
                        if (cartSubtotalEl) cartSubtotalEl.textContent = formatNumber(data.cart_total);
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
                    .catch(function() {
                        if (note) {
                            note.textContent = 'Something went wrong while updating quantity.';
                            note.style.display = '';
                        }
                    })
                    .finally(function() {
                        row.classList.remove('cart-row-updating');
                    });
            }

            function debouncedUpdate(row, input) {
                var bookId = row.getAttribute('data-book-id');
                clearTimeout(debounceTimers[bookId]);
                debounceTimers[bookId] = setTimeout(function() {
                    submitQtyUpdate(row, input);
                }, 300);
            }

            cartBody.addEventListener('change', function(e) {
                if (!e.target.classList.contains('cart-qty-input')) return;
                var row = e.target.closest('.cartx-item');
                debouncedUpdate(row, e.target);
            });

            cartBody.addEventListener('click', function(e) {
                var btn = e.target.closest('.cart-qty-btn');
                if (!btn) return;

                var row = btn.closest('.cartx-item');
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

            cartBody.addEventListener('submit', function(e) {
                if (!e.target.classList.contains('cart-qty-form')) return;
                e.preventDefault();
                var row = e.target.closest('.cartx-item');
                submitQtyUpdate(row, row.querySelector('.cart-qty-input'));
            });
        });
    </script>

@endsection
