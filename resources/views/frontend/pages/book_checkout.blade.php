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
                                <label>Delivery Zone *</label>
                                <select name="delivery_zone" id="delivery_zone" required>
                                    <option value="">-- Select Delivery Zone --</option>
                                    <option value="inside_dhaka" data-charge="{{ $delivery_charges['inside_dhaka'] }}" {{ old('delivery_zone') == 'inside_dhaka' ? 'selected' : '' }}>
                                        Inside Dhaka (৳ {{ number_format($delivery_charges['inside_dhaka']) }})
                                    </option>
                                    <option value="outside_dhaka" data-charge="{{ $delivery_charges['outside_dhaka'] }}" {{ old('delivery_zone') == 'outside_dhaka' ? 'selected' : '' }}>
                                        Outside Dhaka (৳ {{ number_format($delivery_charges['outside_dhaka']) }})
                                    </option>
                                    <option value="suburbs" data-charge="{{ $delivery_charges['suburbs'] }}" {{ old('delivery_zone') == 'suburbs' ? 'selected' : '' }}>
                                        Suburbs (৳ {{ number_format($delivery_charges['suburbs']) }})
                                    </option>
                                </select>
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
                        <div class="checkout-summary__item">
                            <span class="checkout-summary__item-title">Subtotal</span>
                            <span class="checkout-summary__item-price">৳ <span id="summary-subtotal">{{ number_format($total) }}</span></span>
                        </div>
                        <div class="checkout-summary__item">
                            <span class="checkout-summary__item-title">Delivery Charge</span>
                            <span class="checkout-summary__item-price">৳ <span id="summary-delivery">0</span></span>
                        </div>
                        <div class="checkout-summary__total">
                            <span>Total</span>
                            <strong>৳ <span id="summary-total">{{ number_format($total) }}</span></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var subtotal = {{ (int) $total }};
            var zoneSelect = document.getElementById('delivery_zone');
            var deliveryEl = document.getElementById('summary-delivery');
            var totalEl = document.getElementById('summary-total');

            if (!zoneSelect) return;

            function formatNumber(n) {
                return Number(n).toLocaleString('en-US');
            }

            function recalc() {
                var selected = zoneSelect.options[zoneSelect.selectedIndex];
                var charge = selected ? parseInt(selected.getAttribute('data-charge') || '0', 10) : 0;
                if (isNaN(charge)) charge = 0;
                deliveryEl.textContent = formatNumber(charge);
                totalEl.textContent = formatNumber(subtotal + charge);
            }

            // Native change (keyboard / programmatic dispatch, non-JS-enhanced select)
            zoneSelect.addEventListener('change', recalc);

            // The theme auto-applies jquery.nice-select to every <select>, and nice-select
            // updates the hidden original <select> via jQuery's `.trigger('change')`, which
            // only notifies jQuery-bound handlers — it does NOT dispatch a native DOM
            // 'change' event, so addEventListener alone misses it. Bind through jQuery too.
            function bindNiceSelect() {
                if (window.jQuery) {
                    jQuery(zoneSelect).on('change', recalc);
                    return true;
                }
                return false;
            }

            if (!bindNiceSelect()) {
                // jQuery/nice-select scripts loaded async or deferred — retry briefly.
                var tries = 0;
                var poll = setInterval(function () {
                    tries++;
                    if (bindNiceSelect() || tries > 40) {
                        clearInterval(poll);
                    }
                }, 100);
            }

            // As an extra safety net, also poll the select's value for changes
            // (covers any UI plugin that mutates the value without any event at all).
            var lastValue = zoneSelect.value;
            setInterval(function () {
                if (zoneSelect.value !== lastValue) {
                    lastValue = zoneSelect.value;
                    recalc();
                }
            }, 300);

            recalc();
        });
    </script>

@endsection