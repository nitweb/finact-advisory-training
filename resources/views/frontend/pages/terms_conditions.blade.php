@extends('frontend.dashboard')
@section('frontend_title', 'Terms of Service')
@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Terms of Service</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Terms of Service</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Services Page Start -->
    <section class="service-details">

        <div class="container">

            <div class="row">

                <div class="col-xl-12 col-lg-7">

                    <div class="service-details__left">

                        <div class="service-details__text-1" style="text-align: justify;">

                            <h2>Terms of Service</h2>

                            <br>

                            <p>Welcome to Finact Advisory Training. By accessing or using our website and services, you agree to comply with and be bound by the following Terms of Service. Please read them carefully.</p>

                            <br>

                            <h3>1. Acceptance of Terms</h3>
                            <p>By using this website, you agree to follow these terms and all applicable laws and regulations. If you do not agree, please do not use our services.</p>

                            <br>

                            <h3>2. Services Offered</h3>
                            <p>Finact Advisory Training provides professional training programs in accounting, finance, tax, VAT, and related areas. We reserve the right to modify or discontinue any service at any time without prior notice.</p>

                            <br>

                            <h3>3. User Responsibilities</h3>
                            <p>Users agree to provide accurate information during registration and use the website only for lawful purposes. Any misuse, unauthorized access, or harmful activity is strictly prohibited.</p>

                            <br>

                            <h3>4. Payment and Refund Policy</h3>
                            <p>All payments for training programs must be completed as per the provided instructions. Fees are generally non-refundable unless otherwise stated. Special cases may be reviewed at our discretion.</p>

                            <br>

                            <h3>5. Intellectual Property</h3>
                            <p>All content, including training materials, videos, and documents, are the property of Finact Advisory Training. You may not copy, distribute, or reproduce any content without permission.</p>

                            <br>

                            <h3>6. Limitation of Liability</h3>
                            <p>We are not responsible for any direct or indirect damages resulting from the use or inability to use our services. Users participate in training programs at their own risk.</p>

                            <br>

                            <h3>7. Privacy</h3>
                            <p>Your personal information will be handled according to our Privacy Policy. We take reasonable measures to protect your data.</p>

                            <br>

                            <h3>8. Changes to Terms</h3>
                            <p>We may update these Terms of Service at any time. Continued use of the website means you accept the updated terms.</p>

                            <br>

                            <h3>9. Contact Information</h3>
                            <p>If you have any questions about these Terms, please contact us through our official website or support channels.</p>

                            <br>

                            <p><strong>Last Updated:</strong> April 2026</p>

                        </div>

                    </div>
                </div>

            </div>

        </div>

    </section>
    <!--Services Page End -->

@endsection
