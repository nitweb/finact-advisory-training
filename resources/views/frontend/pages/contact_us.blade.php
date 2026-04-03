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
    <section class="contact-page" style="padding: 120px 0;">

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

                            <form class=" contact-one__form" action="{{ route('admin.contact.store') }}" method="post">

                                @csrf

                                <div class="row">

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <h4 class="contact-one__input-title">Full Name</h4>
                                        <div class="contact-one__input-box">
                                            <div class="contact-one__input-icon">
                                                <span class="icon-user"></span>
                                            </div>
                                            <input type="text" name="name" placeholder="Your Name" required="">
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <h4 class="contact-one__input-title">Email Address</h4>
                                        <div class="contact-one__input-box">
                                            <div class="contact-one__input-icon">
                                                <span class="icon-mail"></span>
                                            </div>
                                            <input type="email" name="email" placeholder="Your Email" required="">
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <h4 class="contact-one__input-title">Phone Number</h4>
                                        <div class="contact-one__input-box">
                                            <div class="contact-one__input-icon">
                                                <span class="icon-phone-call"></span>
                                            </div>
                                            <input type="text" name="phone" placeholder="Phone / WhatsApp" required="">
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <h4 class="contact-one__input-title">Organization Name</h4>
                                        <div class="contact-one__input-box">
                                            <div class="contact-one__input-icon">
                                                <span class="icon-edit"></span>
                                            </div>
                                            <input type="text" name="organization" placeholder="Organization Name" required="">
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <h4 class="contact-one__input-title">Select a Service</h4>
                                        <div class="contact-one__input-box">
                                            <select name="service" required="">
                                                <option value="" disabled selected>Select a Service</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xl-12">
                                    <h4 class="contact-one__input-title">Inquiry about </h4>
                                    <div class="contact-one__input-box text-message-box">
                                        <div class="contact-one__input-icon">
                                            <span class="icon-edit"></span>
                                        </div>
                                        <textarea name="message" placeholder="Write your message" required=""></textarea>
                                    </div>
                                    <div class="contact-one__btn-box">
                                        <button type="submit" class="thm-btn">
                                            Submit Inquiry
                                            <span class="fas fa-arrow-right"></span></button>
                                    </div>
                                </div>

                                <div class="result"></div>

                            </form>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {

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

            document.getElementById('contact-form').addEventListener('submit', function() {
                const btn = this.querySelector('button[type="submit"]');
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
            });

        });
    </script>
@endsection
