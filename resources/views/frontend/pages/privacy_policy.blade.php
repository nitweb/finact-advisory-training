@extends('frontend.dashboard')
@section('frontend_title', 'Privacy Policy')
@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Privacy Policy</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Privacy Policy</li>
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

                            <h2>Privacy Policy</h2>

                            <br>

                            <p>Finact Advisory Training values your privacy and is committed to protecting your personal information. This Privacy Policy explains how we collect, use, and safeguard your data when you use our website and services.</p>

                            <br>

                            <h3>1. Information We Collect</h3>
                            <p>We may collect personal information such as your name, email address, phone number, and payment details when you register for our training programs or interact with our website.</p>

                            <br>

                            <h3>2. How We Use Your Information</h3>
                            <p>Your information is used to:
                            <ul>
                                <li>Provide and manage training services</li>
                                <li>Process payments and registrations</li>
                                <li>Communicate with you regarding updates and support</li>
                                <li>Improve our services and user experience</li>
                            </ul>
                            </p>

                            <br>

                            <h3>3. Data Protection</h3>
                            <p>We implement reasonable security measures to protect your personal data from unauthorized access, disclosure, or misuse. However, no method of transmission over the internet is completely secure.</p>

                            <br>

                            <h3>4. Sharing of Information</h3>
                            <p>We do not sell, trade, or rent your personal information to third parties. We may share data with trusted service providers only when necessary to operate our services.</p>

                            <br>

                            <h3>5. Cookies</h3>
                            <p>Our website may use cookies to enhance user experience and analyze website traffic. You can choose to disable cookies through your browser settings.</p>

                            <br>

                            <h3>6. Your Rights</h3>
                            <p>You have the right to access, update, or request deletion of your personal information. You may contact us for any such requests.</p>

                            <br>

                            <h3>7. Third-Party Links</h3>
                            <p>Our website may contain links to external websites. We are not responsible for the privacy practices of those sites.</p>

                            <br>

                            <h3>8. Changes to This Policy</h3>
                            <p>We may update this Privacy Policy at any time. Continued use of our website means you accept the updated policy.</p>

                            <br>

                            <h3>9. Contact Us</h3>
                            <p>If you have any questions regarding this Privacy Policy, please contact us through our official website.</p>

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
