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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-bottom:0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('frontend.book.checkout.submit') }}" method="POST" id="checkout-form" autocomplete="off">
                @csrf

                <div class="row">
                    <div class="col-lg-7">

                        <div class="checkout-panel">
                            <h4><span class="icon-badge">&#128205;</span> Delivery Information</h4>

                            <div class="checkout-field">
                                <label>Full Name *</label>
                                <input type="text" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="checkout-field-row">
                                <div class="checkout-field">
                                    <label>Phone Number *</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="01XXXXXXXXX" required>
                                </div>
                                <div class="checkout-field">
                                    <label>Email (optional)</label>
                                    <input type="email" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="checkout-field">
                                <label>Full Address *</label>
                                <textarea name="address" required>{{ old('address') }}</textarea>
                            </div>

                            <div class="checkout-field">
                                <label>Order Note (optional)</label>
                                <textarea name="note">{{ old('note') }}</textarea>
                            </div>
                        </div>

                        <div class="checkout-panel">
                            <h4><span class="icon-badge">&#128179;</span> Payment Method *</h4>

                            @php $selectedPayment = old('payment_method', 'cod'); @endphp

                            <label class="pay-option {{ $selectedPayment == 'cod' ? 'active' : '' }}" data-pay="cod">
                                <input type="radio" name="payment_method" value="cod" {{ $selectedPayment == 'cod' ? 'checked' : '' }}>
                                <span class="pay-option__left">
                                    <span class="pay-option__logo cod">COD</span>
                                    <span class="pay-option__name">Cash on Delivery</span>
                                </span>
                                <span class="pay-option__dot"></span>
                            </label>

                            <label class="pay-option {{ $selectedPayment == 'bkash' ? 'active' : '' }}" data-pay="bkash">
                                <input type="radio" name="payment_method" value="bkash" {{ $selectedPayment == 'bkash' ? 'checked' : '' }}>
                                <span class="pay-option__left">
                                    <span class="pay-option__logo bkash">bKash</span>
                                    <span class="pay-option__name">Pay with bKash</span>
                                </span>
                                <span class="pay-option__dot"></span>
                            </label>

                            {{-- Manual bKash payment (verified by admin) --}}
                            <div class="bkash-section" id="bkash-fields" style="margin:14px 0 0; {{ $selectedPayment == 'bkash' ? '' : 'display:none;' }}">
                                <div class="bkash-section__title">
                                    <i class="fas fa-mobile-screen-button"></i>
                                    bKash Payment
                                </div>

                                <div class="bkash-instruction">
                                    <strong>How to pay:</strong>
                                    Send <strong style="display:inline;">&#2547; <span id="bkash-amount">{{ number_format($total) }}</span></strong>
                                    to the bKash number below using <strong style="display:inline;">Send Money</strong>
                                    then enter your bKash number and Transaction ID below.
                                </div>

                                <div class="bkash-number-display">
                                    <i class="fas fa-phone-alt"></i>
                                    {{ siteSetting()->bkash_number ?? '01325221133' }}
                                </div>

                                <div class="checkout-field-row">
                                    <div class="checkout-field">
                                        <label>Your bKash Number *</label>
                                        <input type="text" name="bkash_number" id="bkash_number" value="{{ old('bkash_number') }}" placeholder="01XXXXXXXXX" pattern="^(?:\+?88)?01[3-9]\d{8}$" maxlength="14" {{ $selectedPayment == 'bkash' ? 'required' : 'disabled' }}>
                                    </div>
                                    <div class="checkout-field">
                                        <label>Transaction ID *</label>
                                        <input type="text" name="bkash_trx_id" id="bkash_trx_id" value="{{ old('bkash_trx_id') }}" placeholder="e.g. 8A7B6C5D4E" maxlength="100" {{ $selectedPayment == 'bkash' ? 'required' : 'disabled' }}>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5">
                        <div class="checkout-summary">
                            <h4>Order Summary</h4>
                            @foreach ($cart as $item)
                                <div class="checkout-summary__item">
                                    <span class="checkout-summary__item-title">{{ $item['title'] }} <span style="color:#9ca3af;">x{{ $item['quantity'] }}</span></span>
                                    <span class="checkout-summary__item-price">&#2547;{{ number_format($item['price'] * $item['quantity']) }}</span>
                                </div>
                            @endforeach
                            <div class="checkout-summary__item">
                                <span class="checkout-summary__item-title">Subtotal</span>
                                <span class="checkout-summary__item-price">&#2547;<span id="summary-subtotal">{{ number_format($total) }}</span></span>
                            </div>
                            <div class="checkout-summary__item">
                                <span class="checkout-summary__item-title">Delivery Charge</span>
                                <span class="checkout-summary__item-price">&#2547;<span id="summary-delivery">0</span></span>
                            </div>
                            <div class="checkout-summary__total">
                                <span>Total</span>
                                <strong>&#2547;<span id="summary-total">{{ number_format($total) }}</span></strong>
                            </div>

                            <div class="checkout-panel">
                                <h4><span class="icon-badge">&#128666;</span> Delivery Area *</h4>

                                @php
                                    $zones = [
                                        'inside_dhaka' => ['label' => 'Inside Dhaka', 'sub' => 'Delivery in 1-2 days'],
                                        'suburbs' => ['label' => 'Dhaka Suburb', 'sub' => 'Gazipur, Narayanganj, Savar etc. - 2-3 days'],
                                        'outside_dhaka' => ['label' => 'Outside Dhaka', 'sub' => 'Nationwide - 3-5 days'],
                                    ];
                                    $selectedZone = old('delivery_zone', 'inside_dhaka');
                                @endphp

                                @foreach ($zones as $key => $zone)
                                    <label class="zone-option {{ $selectedZone == $key ? 'active' : '' }}" data-zone="{{ $key }}">
                                        <input type="radio" name="delivery_zone" value="{{ $key }}" data-charge="{{ $delivery_charges[$key] }}" {{ $selectedZone == $key ? 'checked' : '' }} required>
                                        <span class="zone-option__left">
                                            <span class="zone-option__dot"></span>
                                            <span>
                                                <span class="zone-option__name">{{ $zone['label'] }}</span>
                                                <span class="zone-option__sub">{{ $zone['sub'] }}</span>
                                            </span>
                                        </span>
                                        <span class="zone-option__price">&#2547;{{ number_format($delivery_charges[$key]) }}</span>
                                    </label>
                                @endforeach
                            </div>

                            <button type="submit" class="checkout-pay-btn">
                                <i class="fas fa-lock"></i> Confirm Order
                            </button>
                            <div class="checkout-secure-note">&#128274; Safe &amp; secure checkout</div>
                        </div>
                    </div>
                </div>

            </form>

        </div>

    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var subtotal = {{ (int) $total }};
            var deliveryEl = document.getElementById('summary-delivery');
            var totalEl = document.getElementById('summary-total');

            function formatNumber(n) {
                return Number(n).toLocaleString('en-US');
            }

            // Delivery zone cards
            var zoneOptions = document.querySelectorAll('.zone-option');

            function recalc() {
                var checked = document.querySelector('input[name="delivery_zone"]:checked');
                var charge = checked ? parseInt(checked.getAttribute('data-charge') || '0', 10) : 0;
                if (isNaN(charge)) charge = 0;
                deliveryEl.textContent = formatNumber(charge);
                totalEl.textContent = formatNumber(subtotal + charge);
                var bkashAmount = document.getElementById('bkash-amount');
                if (bkashAmount) bkashAmount.textContent = formatNumber(subtotal + charge);
            }

            zoneOptions.forEach(function(option) {
                option.addEventListener('click', function() {
                    zoneOptions.forEach(function(o) {
                        o.classList.remove('active');
                    });
                    option.classList.add('active');
                    option.querySelector('input[type="radio"]').checked = true;
                    recalc();
                });
            });

            // Payment method cards
            var payOptions = document.querySelectorAll('.pay-option');
            var bkashBox = document.getElementById('bkash-fields');
            var bkashInputs = bkashBox.querySelectorAll('input');

            function togglePayment(method) {
                var isBkash = method === 'bkash';
                bkashBox.style.display = isBkash ? '' : 'none';
                bkashInputs.forEach(function(input) {
                    input.disabled = !isBkash;
                    input.required = isBkash;
                });
            }

            payOptions.forEach(function(option) {
                option.addEventListener('click', function() {
                    payOptions.forEach(function(o) {
                        o.classList.remove('active');
                    });
                    option.classList.add('active');
                    var radio = option.querySelector('input[type="radio"]');
                    radio.checked = true;
                    togglePayment(radio.value);
                });
            });

            function syncPayment() {
                var checkedPay = document.querySelector('input[name="payment_method"]:checked');
                var method = checkedPay ? checkedPay.value : 'cod';
                if (!checkedPay) {
                    document.querySelector('input[name="payment_method"][value="cod"]').checked = true;
                }
                payOptions.forEach(function(o) {
                    o.classList.toggle('active', o.getAttribute('data-pay') === method);
                });
                togglePayment(method);
            }

            var serverDefault = '{{ $selectedPayment }}';
            var defaultRadio = document.querySelector('input[name="payment_method"][value="' + serverDefault + '"]');
            if (defaultRadio) defaultRadio.checked = true;

            syncPayment();

            // Back/forward cache: restore the correct state
            window.addEventListener('pageshow', function(e) {
                if (e.persisted) syncPayment();
            });

            recalc();
        });
    </script>

@endsection
