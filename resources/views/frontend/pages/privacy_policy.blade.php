@extends('frontend.master')

@section('frontend_title', 'Privacy Policy')

@section('frontend_content')

    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-bottom: 0;
            margin-top: 20px;
        }
    </style>

    <div class="wrap-slider" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://mazamanca.com/frontend/img/cover_about_us.jpg') no-repeat center; background-size: cover; height: 100px; display: flex; align-items: center; justify-content: center;">
        <div class="container text-center">
            <h1 style="color: #fff; font-size: 2.5rem; font-weight: bold; margin: 0;">Privacy Policy</h1>
            <ul class="breadcrumbs" style="list-style: none; padding: 0; display: inline-flex; gap: 10px; color: #fff;">
                <li><a href="{{ route('frontend.index') }}" style="color: #fff; text-decoration: none;">Home</a></li>
                <li>/</li>
                <li>Privacy Policy</li>
            </ul>
        </div>
    </div>

    <section class="flat-row v16 choose-us2">

        <div class="container">

            <div class="row">

                <div class="col-md-12 ove-hide">

                    <div class="divider h31">

                    </div>

                    <div class="wrap-iconbox">

                        <div class="iconbox compact left style2 maxwidth">

                            <div class="box-content" style="text-align: justify;">

                                <p>At Rahman Anis & Co - Chartered Accountants, we are committed to protecting your privacy. This Privacy Policy explains how we collect, use, and disclose personal information when you use our website.</p>

                                <h5>Information We Collect</h5>
                                <p>We collect personal information that you voluntarily provide to us when you register on our website, place an order, or interact with our services. This may include your name, email address, phone number, and payment information.</p>

                                <h5>How We Use Your Information</h5>
                                <p>We use the information we collect for the following purposes:</p>
                                <ul>
                                    <li>To provide, operate, and maintain our services.</li>
                                    <li>To process transactions and manage customer orders.</li>
                                    <li>To send you updates, marketing communications, or customer service messages.</li>
                                    <li>To improve and personalize your experience on our website.</li>
                                </ul>

                                <h5>Information Sharing and Disclosure</h5>
                                <p>We do not share your personal information with third parties except in the following cases:</p>
                                <ul>
                                    <li>When required by law, or to comply with a legal obligation.</li>
                                    <li>To trusted service providers who assist us in operating our business, subject to confidentiality agreements.</li>
                                </ul>

                                <h5>Data Security</h5>
                                <p>We take appropriate security measures to protect your personal information from unauthorized access, disclosure, alteration, or destruction.</p>

                                <h5>Cookies</h5>
                                <p>Our website may use cookies to improve user experience. You have the option to accept or decline cookies through your browser settings.</p>

                                <h5>Your Rights</h5>
                                <p>You have the right to access, update, or delete your personal information. To exercise these rights, please contact us at info@rahmananis.com.</p>

                                <h5>Changes to This Privacy Policy</h5>
                                <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated revision date.</p>

                                <h5>Contact Us</h5>
                                <p>If you have any questions about this Privacy Policy, please contact us at info@rahmananis.com.</p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
