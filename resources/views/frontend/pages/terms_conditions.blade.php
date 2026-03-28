@extends('frontend.master')

@section('frontend_title', 'Terms & Conditions')

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
            <h1 style="color: #fff; font-size: 2.5rem; font-weight: bold; margin: 0;">Terms & Conditions</h1>
            <ul class="breadcrumbs" style="list-style: none; padding: 0; display: inline-flex; gap: 10px; color: #fff;">
                <li><a href="{{ route('frontend.index') }}" style="color: #fff; text-decoration: none;">Home</a></li>
                <li>/</li>
                <li>Terms & Conditions</li>
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

                                <p>Welcome to Rahman Anis & Co - Chartered Accountants! By accessing or using our website, you agree to comply with the following terms and conditions. Please read them carefully.</p>

                                <h5>Acceptance of Terms</h5>
                                <p>By accessing this website, you accept these Terms & Conditions in full. If you disagree with any part of these terms, you must not use our website.</p>

                                <h5>Use of the Website</h5>
                                <p>You agree to use this website only for lawful purposes and in a way that does not infringe the rights of, restrict, or inhibit anyone else's use of the website. Prohibited behavior includes harassing or causing distress or inconvenience to any other user, transmitting obscene or offensive content, or disrupting the normal flow of dialogue on the website.</p>

                                <h5>Intellectual Property</h5>
                                <p>All content on this website, including text, graphics, logos, images, and software, is the property of Rahman Anis & Co - Chartered Accountants or its content suppliers and is protected by applicable copyright, trademark, and other intellectual property laws. You may not reproduce, distribute, or modify any content from this website without our prior written consent.</p>

                                <h5>Limitation of Liability</h5>
                                <p>Rahman Anis & Co - Chartered Accountants will not be held liable for any damages arising from the use or inability to use this website, including but not limited to direct, indirect, incidental, punitive, and consequential damages. We do not warrant that the website will be error-free or that access will be continuous or uninterrupted.</p>

                                <h5>User Accounts</h5>
                                <p>If you create an account on our website, you are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer. You agree to accept responsibility for all activities that occur under your account or password.</p>

                                <h5>Third-Party Links</h5>
                                <p>This website may contain links to third-party websites. We are not responsible for the content or privacy practices of such websites, and accessing any third-party links is at your own risk.</p>

                                <h5>Governing Law</h5>
                                <p>These Terms & Conditions are governed by and construed in accordance with the laws of Bangladesh, and you irrevocably submit to the exclusive jurisdiction of the courts in that location.</p>

                                <h5>Changes to These Terms</h5>
                                <p>We reserve the right to modify these Terms & Conditions at any time. Any changes will be posted on this page with an updated revision date. By continuing to use our website after any changes, you agree to the updated terms.</p>

                                <h5>Contact Information</h5>
                                <p>If you have any questions about these Terms & Conditions, please contact us at info@rahmananis.com.</p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
