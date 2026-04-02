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

    <!--Contact Info Start-->
    <section class="contact-info">

        <div class="container">

            <div class="row align-items-stretch">

                <!--Contact Two Single Start-->
                <div class="col-xl-4 col-lg-4 wow fadeInLeft" data-wow-delay="100ms">
                    <div class="contact-info__single h-100">
                        <div class="contact-info__icon">
                            <span class="icon-call"></span>
                        </div>
                        <p>Contact Us</p>
                        <h3><a href="tel:{{ $site_setting->site_phone }}">{{ $site_setting->site_phone }}</a></h3>
                        <h3><a href="tel:{{ $site_setting->site_phone_alter }}">{{ $site_setting->site_phone_alter }}</a></h3>
                    </div>
                </div>

                <!--Contact Two Single Start-->
                <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                    <div class="contact-info__single h-100">
                        <div class="contact-info__icon">
                            <span class="icon-email"></span>
                        </div>
                        <p>Email Us</p>
                        <h3><a href="mailto:{{ $site_setting->site_email }}">{{ $site_setting->site_email }}</a></h3>
                        <h3><a href="mailto:{{ $site_setting->site_email_alter }}">{{ $site_setting->site_email_alter }}</a></h3>
                    </div>
                </div>

                <!--Contact Two Single Start-->
                <div class="col-xl-4 col-lg-4 wow fadeInRight" data-wow-delay="300ms">
                    <div class="contact-info__single h-100">
                        <div class="contact-info__icon">
                            <span class="icon-pin"></span>
                        </div>
                        <p>Our Office Location</p>
                        <h3>{{ $site_setting->head_address }}</h3>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <!--Contact Page Start-->
    <section class="contact-page">

        <div class="container">

            <div class="contact-page__inner">

                <div class="contact-page__bg-shape" style="background-image: url(assets/images/shapes/contact-page-bg-shape.png);"></div>

                <div class="row">

                    <div class="col-xl-6">
                        <div class="contact-page__left">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d69458.5373366037!2d90.38106637382354!3d23.802074748506655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1775044694468!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                    <div class="col-xl-6">

                        <div class="contact-page__right">

                            <h3 class="contact-page__form-title">Get in Touch</h3>

                            <p style="color: #fff; margin-bottom:30px;margin-top: -20px;">We would be pleased to discuss your requirements and explore how we can support your business.</p>

                            <form id="contact-form" class="contact-page__form" action="{{ route('admin.contact.store') }}" method="POST">

                                @csrf

                                <div class="row">

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="contact-page__input-box">
                                            <input type="text" name="name" placeholder="Your Name" required="">
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="contact-page__input-box">
                                            <input type="email" name="email" placeholder="Your Email" required="">
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="contact-page__input-box">
                                            <input type="text" name="phone" placeholder="Phone / WhatsApp" required="">
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="contact-page__input-box">
                                            <input type="text" name="organization" placeholder="Organization Name" required="">
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <div class="contact-page__input-box">
                                            <select name="service" required="">
                                                <option value="" disabled selected>Select a Service</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="contact-page__input-box text-message-box">
                                            <textarea name="message" placeholder="Message" required=""></textarea>
                                        </div>
                                        <div class="contact-page__btn-box">
                                            <button type="submit" class="thm-btn contact-page__btn">
                                                Submit Inquiry <span class="fas fa-arrow-right"></span>
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!--Contact Page End-->

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
