@extends('frontend.dashboard')
@section('frontend_title', 'Contact Us')
@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Contact</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Contact Page Start-->
    <section class="contact-page">

        <div class="container">

            <div class="row">

                <div class="col-xl-6">
                    <div class="contact-three__left">
                        <div class="section-title text-left sec-title-animation animation-style2">
                            <div class="section-title__tagline-box">
                                <span class="section-title__tagline">Get In Touch</span>
                            </div>
                            <h2 class="section-title__title title-animation">Conversation
                                <span>– Reach</span><br><span>Out Anytime</span>
                            </h2>
                        </div>
                        <p class="contact-three__text">
                            We would be pleased to discuss your requirements and <br> explore how we can support your business.
                        </p>

                        <ul class="contact-three__contact-list list-unstyled">
                            <li>
                                <div class="icon">
                                    <span class="icon-email"></span>
                                </div>
                                <div class="content">
                                    <span>Email Us</span>
                                    <p><a href="mailto:{{ $site_setting->site_email }}">{{ $site_setting->site_email }}</a></p>
                                    <p><a href="mailto:{{ $site_setting->site_email_alter }}">{{ $site_setting->site_email_alter }}</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-call"></span>
                                </div>
                                <div class="content">
                                    <span>Contact US</span>
                                    <p><a href="tel:{{ $site_setting->site_phone }}">{{ $site_setting->site_phone }}</a></p>
                                    <p><a href="tel:{{ $site_setting->site_phone_alter }}">{{ $site_setting->site_phone_alter }}</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-pin"></span>
                                </div>
                                <div class="content">
                                    <span>Our Address</span>
                                    <p>{{ $site_setting->head_address }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-6">

                    <div class="contact-three__right">

                        <div class="contact-three__img-1">
                            <img src="{{ asset('frontend/assets/images/resources/contact-three-img-1.png') }}" alt="">
                        </div>

                        <div class="contact-one__right">

                            {{-- ===================== FORM START ===================== --}}
                            <form class="contact-one__form" id="contact-form" action="{{ route('admin.contact.store') }}" method="post" novalidate>

                                @csrf

                                <div class="row">

                                    {{-- Full Name --}}
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <h4 class="contact-one__input-title">Full Name</h4>
                                        <div class="contact-one__input-box" id="box-name">
                                            <div class="contact-one__input-icon">
                                                <span class="icon-user"></span>
                                            </div>
                                            <input type="text" name="name" id="field-name" placeholder="Your Name" value="{{ old('name') }}">
                                        </div>
                                        <p class="field-error-msg" id="error-name">⚠️ Full Name is required.</p>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <h4 class="contact-one__input-title">Email Address</h4>
                                        <div class="contact-one__input-box" id="box-email">
                                            <div class="contact-one__input-icon">
                                                <span class="icon-mail"></span>
                                            </div>
                                            <input type="email" name="email" id="field-email" placeholder="Your Email" value="{{ old('email') }}">
                                        </div>
                                        <p class="field-error-msg" id="error-email">⚠️ A valid Email Address is required.</p>
                                    </div>

                                    {{-- Phone --}}
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <h4 class="contact-one__input-title">Phone / WhatsApp</h4>
                                        <div class="contact-one__input-box" id="box-phone">
                                            <div class="contact-one__input-icon">
                                                <span class="icon-phone-call"></span>
                                            </div>
                                            <input type="text" name="phone" id="field-phone" placeholder="Phone / WhatsApp" value="{{ old('phone') }}">
                                        </div>
                                        <p class="field-error-msg" id="error-phone">⚠️ Phone / WhatsApp number is required.</p>
                                    </div>

                                    {{-- Organization --}}
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <h4 class="contact-one__input-title">Organization Name</h4>
                                        <div class="contact-one__input-box" id="box-organization">
                                            <div class="contact-one__input-icon">
                                                <span class="icon-edit"></span>
                                            </div>
                                            <input type="text" name="organization" id="field-organization" placeholder="Organization Name" value="{{ old('organization') }}">
                                        </div>
                                        <p class="field-error-msg" id="error-organization">⚠️ Organization Name is required.</p>
                                    </div>

                                    {{-- Service --}}
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <h4 class="contact-one__input-title">Select a Service</h4>
                                        <div class="contact-one__input-box" id="box-service">
                                            <select name="service" id="field-service">
                                                <option value="" disabled selected>Select a Service</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}" {{ old('service') == $service->id ? 'selected' : '' }}>
                                                        {{ $service->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <p class="field-error-msg" id="error-service">⚠️ Please select a Service.</p>
                                    </div>

                                </div>

                                {{-- Message --}}
                                <div class="col-xl-12">
                                    <h4 class="contact-one__input-title">Message</h4>
                                    <div class="contact-one__input-box text-message-box" id="box-message">
                                        <div class="contact-one__input-icon">
                                            <span class="icon-edit"></span>
                                        </div>
                                        <textarea name="message" id="field-message" placeholder="Write your message">{{ old('message') }}</textarea>
                                    </div>
                                    <p class="field-error-msg" id="error-message">⚠️ Message is required.</p>

                                    <div class="contact-one__btn-box">
                                        <button type="submit" class="thm-btn" id="submit-btn">
                                            Submit Inquiry
                                            <span class="fas fa-arrow-right"></span>
                                        </button>
                                    </div>
                                </div>

                                <div class="result"></div>

                            </form>
                            {{-- ===================== FORM END ===================== --}}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- Google Map --}}
    <section class="google_map">
        <div style="margin-bottom: -8px;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d69458.5373366037!2d90.38106637382354!3d23.802074748506655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1775044694468!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>


    {{-- ===================== CSS ===================== --}}
    <style>
        /* প্রতিটা field-এর নিচের error message */
        .field-error-msg {
            display: none;
            color: #e53935;
            font-size: 13px;
            margin-top: 5px;
            margin-bottom: 4px;
            font-weight: 500;
            padding-left: 2px;
            animation: errFadeIn 0.2s ease;
        }

        /* লাল border — error */
        .contact-one__input-box.has-error input,
        .contact-one__input-box.has-error textarea,
        .contact-one__input-box.has-error select {
            border: 2px solid #e53935 !important;
            background-color: #fff5f5 !important;
        }

        /* সবুজ border — success */
        .contact-one__input-box.has-success input,
        .contact-one__input-box.has-success textarea,
        .contact-one__input-box.has-success select {
            border: 2px solid #43a047 !important;
            background-color: #f5fff5 !important;
        }

        @keyframes errFadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>


    {{-- ===================== JavaScript ===================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ---- SweetAlert: session messages ----
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Message Sent!',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#e8272b',
                    timer: 4000,
                    timerProgressBar: true,
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: "{{ session('error') }}",
                    confirmButtonText: 'Try Again',
                    confirmButtonColor: '#e8272b',
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'warning',
                    title: 'Validation Error!',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonText: 'Fix It',
                    confirmButtonColor: '#e8272b',
                });
            @endif


            // ---- Form Validation ----
            const form = document.getElementById('contact-form');

            // সব field-এর config
            const fields = [{
                    id: 'field-name',
                    boxId: 'box-name',
                    errorId: 'error-name',
                    type: 'text'
                },
                {
                    id: 'field-email',
                    boxId: 'box-email',
                    errorId: 'error-email',
                    type: 'email'
                },
                {
                    id: 'field-phone',
                    boxId: 'box-phone',
                    errorId: 'error-phone',
                    type: 'text'
                },
                {
                    id: 'field-organization',
                    boxId: 'box-organization',
                    errorId: 'error-organization',
                    type: 'text'
                },
                {
                    id: 'field-service',
                    boxId: 'box-service',
                    errorId: 'error-service',
                    type: 'select'
                },
                {
                    id: 'field-message',
                    boxId: 'box-message',
                    errorId: 'error-message',
                    type: 'text'
                },
            ];

            // একটা field validate করা
            function validateField(config) {
                const el = document.getElementById(config.id);
                const box = document.getElementById(config.boxId);
                const errEl = document.getElementById(config.errorId);

                if (!el) return true;

                const val = el.value.trim();
                let isValid = true;

                if (!val) {
                    isValid = false;
                } else if (config.type === 'email') {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(val)) {
                        isValid = false;
                        errEl.textContent = '⚠️ Please enter a valid email address.';
                    } else {
                        errEl.textContent = '⚠️ A valid Email Address is required.';
                    }
                }

                if (!isValid) {
                    box.classList.add('has-error');
                    box.classList.remove('has-success');
                    errEl.style.display = 'block';
                } else {
                    box.classList.remove('has-error');
                    box.classList.add('has-success');
                    errEl.style.display = 'none';
                }

                return isValid;
            }

            // Real-time validation — টাইপ করার সাথে সাথে check হবে
            fields.forEach(function(config) {
                const el = document.getElementById(config.id);
                if (!el) return;

                const eventType = (config.type === 'select') ? 'change' : 'input';
                el.addEventListener(eventType, function() {
                    validateField(config);
                });
                el.addEventListener('blur', function() {
                    validateField(config);
                });
            });

            // Submit এ সব check
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                let allValid = true;
                let firstInvalid = null;

                fields.forEach(function(config) {
                    const valid = validateField(config);
                    if (!valid) {
                        allValid = false;
                        if (!firstInvalid) {
                            firstInvalid = document.getElementById(config.id);
                        }
                    }
                });

                if (!allValid) {
                    // প্রথম error field-এ scroll + focus
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        firstInvalid.focus();
                    }
                    return;
                }

                // সব ঠিক থাকলে — loading দেখাও, তারপর submit
                const btn = document.getElementById('submit-btn');
                btn.disabled = true;
                btn.innerHTML = 'Sending... <span class="fas fa-spinner fa-spin"></span>';

                Swal.fire({
                    title: 'Sending your message...',
                    text: 'Please wait a moment.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                form.submit();
            });

        });
    </script>

@endsection
