@extends('frontend.dashboard')
@section('frontend_title', 'Global Remote Finance Support')
@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Global Remote Finance Support</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Global Remote Finance Support</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    {{-- Intro Section --}}
    <section class="who-we-are" style="background: none;padding-bottom: 0;text-align: center;">
        <div class="floating-shape floating-shape-1"></div>
        <div class="floating-shape floating-shape-2"></div>
        <div class="floating-shape floating-shape-3"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="who-we-are__content" data-aos="fade-up">
                        <div class="section-title__tagline-box">
                            <span class="section-title__tagline">Remote Finance Services</span>
                        </div>
                        <h2 class="section-title__title title-animation mb-4">
                            <span>Structured,</span> Transparent and <span>Reliable Execution</span>
                        </h2>
                        <p class="who-we-are__text" style="text-align: center;">
                            We follow a disciplined and structured approach to ensure clarity, control, and consistent delivery:
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Process Timeline --}}
    <section class="finact-method" style="padding-top: 0;">
        <div class="container">
            <div class="finact-method__timeline">
                <div class="finact-method__step" data-aos="fade-up">
                    <div class="finact-method__step-content">
                        <h3 class="finact-method__step-title">Understanding the Business</h3>
                        <p class="finact-method__step-text">Gaining insight into your operations, objectives, and finance requirements.</p>
                    </div>
                    <div class="finact-method__step-number">1</div>
                </div>
                <div class="finact-method__step" data-aos="fade-up">
                    <div class="finact-method__step-content">
                        <h3 class="finact-method__step-title">Current State Assessment</h3>
                        <p class="finact-method__step-text">Evaluating existing recording, accounting, and reporting practices.</p>
                    </div>
                    <div class="finact-method__step-number">2</div>
                </div>
                <div class="finact-method__step" data-aos="fade-up">
                    <div class="finact-method__step-content">
                        <h3 class="finact-method__step-title">System &amp; Requirement Evaluation</h3>
                        <p class="finact-method__step-text">Assessing system capabilities and identifying functional requirements (subject to access and availability).</p>
                    </div>
                    <div class="finact-method__step-number">3</div>
                </div>
                <div class="finact-method__step" data-aos="fade-up">
                    <div class="finact-method__step-content">
                        <h3 class="finact-method__step-title">Solution Design &amp; Roadmap</h3>
                        <p class="finact-method__step-text">Developing a structured framework covering processes, controls, and reporting.</p>
                    </div>
                    <div class="finact-method__step-number">4</div>
                </div>
                <div class="finact-method__step" data-aos="fade-up">
                    <div class="finact-method__step-content">
                        <h3 class="finact-method__step-title">Commercial Alignment</h3>
                        <p class="finact-method__step-text">Finalizing scope, pricing, and engagement terms.</p>
                    </div>
                    <div class="finact-method__step-number">5</div>
                </div>
                <div class="finact-method__step" data-aos="fade-up">
                    <div class="finact-method__step-content">
                        <h3 class="finact-method__step-title">Implementation &amp; Execution</h3>
                        <p class="finact-method__step-text">Initiating and managing service delivery with defined workflows and responsibilities.</p>
                    </div>
                    <div class="finact-method__step-number">6</div>
                </div>
                <div class="finact-method__step" data-aos="fade-up">
                    <div class="finact-method__step-content">
                        <h3 class="finact-method__step-title">Monitoring &amp; Reporting</h3>
                        <p class="finact-method__step-text">Ongoing review, progress reporting, and coordination.</p>
                    </div>
                    <div class="finact-method__step-number">7</div>
                </div>
                <div class="finact-method__step" data-aos="fade-up">
                    <div class="finact-method__step-content">
                        <h3 class="finact-method__step-title">Quality Assurance &amp; Delivery</h3>
                        <p class="finact-method__step-text">Final review, quality checks, and structured delivery of outputs.</p>
                    </div>
                    <div class="finact-method__step-number">8</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Remote Service Scope --}}
    <section class="who-we-serve">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Service Scope</span>
                </div>
                <h2 class="section-title__title title-animation mb-4">
                    Remote <span>Service</span> Scope
                </h2>
                <p class="section-header__desc">We provide end-to-end accounting support—not limited to bookkeeping.</p>
            </div>
            <div class="who-we-serve__wrapper">
                <div class="who-we-serve__item" data-aos="fade-up" data-aos-delay="100">
                    <div class="who-we-serve__item-icon"><i class="fas fa-cogs"></i></div>
                    <h4 class="who-we-serve__item-title">Accounting System Setup &amp; Chart of Accounts Design</h4>
                </div>
                <div class="who-we-serve__item" data-aos="fade-up" data-aos-delay="150">
                    <div class="who-we-serve__item-icon"><i class="fas fa-book"></i></div>
                    <h4 class="who-we-serve__item-title">Bookkeeping &amp; Financial Record Maintenance</h4>
                </div>
                <div class="who-we-serve__item" data-aos="fade-up" data-aos-delay="200">
                    <div class="who-we-serve__item-icon"><i class="fas fa-exchange-alt"></i></div>
                    <h4 class="who-we-serve__item-title">Accounts Payable &amp; Receivable Management</h4>
                </div>
                <div class="who-we-serve__item" data-aos="fade-up" data-aos-delay="250">
                    <div class="who-we-serve__item-icon"><i class="fas fa-boxes"></i></div>
                    <h4 class="who-we-serve__item-title">Inventory Accounting &amp; Control</h4>
                </div>
                <div class="who-we-serve__item" data-aos="fade-up" data-aos-delay="300">
                    <div class="who-we-serve__item-icon"><i class="fas fa-university"></i></div>
                    <h4 class="who-we-serve__item-title">Bank &amp; Credit Card Reconciliation</h4>
                </div>
                <div class="who-we-serve__item" data-aos="fade-up" data-aos-delay="350">
                    <div class="who-we-serve__item-icon"><i class="fas fa-chart-bar"></i></div>
                    <h4 class="who-we-serve__item-title">Management Reporting (P&amp;L, Balance Sheet, MIS)</h4>
                </div>
            </div>
        </div>
    </section>

    {{-- Technology --}}
    <section class="philosophy-section">
        <div class="container">
            <div class="philosophy__content" data-aos="fade-up">
                <div class="philosophy__icon"><i class="fas fa-laptop"></i></div>
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Technology</span>
                </div>
                <h2 class="section-title__title title-animation mb-4">
                    <span>Technology</span> Environment
                </h2>
                <p class="philosophy__text">
                    We support established cloud-based accounting platforms such as QuickBooks and Xero, along with appropriate document management tools, enabling efficient, transparent, and well-controlled financial operations.
                </p>
            </div>
        </div>
    </section>

    {{-- Operating Principles --}}
    <section class="what-we-do">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Principles</span>
                </div>
                <h2 class="section-title__title title-animation mb-4">
                    Our <span>Operating</span> Principles
                </h2>
            </div>
            <div class="what-we-do__cards what-we-do__cards--2col">
                <div class="what-we-do__card" data-aos="fade-up" data-aos-delay="100">
                    <div class="what-we-do__card-icon"><i class="fas fa-user-shield"></i></div>
                    <h3 class="what-we-do__card-title">Professional Oversight &amp; Periodic Review</h3>
                </div>
                <div class="what-we-do__card" data-aos="fade-up" data-aos-delay="200">
                    <div class="what-we-do__card-icon"><i class="fas fa-lock"></i></div>
                    <h3 class="what-we-do__card-title">Data Confidentiality with Controlled Access Protocols</h3>
                </div>
                <div class="what-we-do__card" data-aos="fade-up" data-aos-delay="300">
                    <div class="what-we-do__card-icon"><i class="fas fa-chart-line"></i></div>
                    <h3 class="what-we-do__card-title">Consistent Reporting &amp; Process Discipline</h3>
                </div>
                <div class="what-we-do__card" data-aos="fade-up" data-aos-delay="400">
                    <div class="what-we-do__card-icon"><i class="fas fa-clock"></i></div>
                    <h3 class="what-we-do__card-title">Continuity of Operations Across Time Zones</h3>
                </div>
            </div>
        </div>
    </section>

    {{-- Message --}}
    <section class="philosophy-section">
        <div class="container">
            <div class="philosophy__content" data-aos="fade-up">
                <div class="philosophy__icon"><i class="fas fa-envelope-open-text"></i></div>
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">To Our Partners</span>
                </div>
                <h2 class="section-title__title title-animation mb-4">
                    A Message to Our <span>Global Partners</span>
                </h2>
                <p class="philosophy__text">
                    We recognize that engaging external finance support requires a high level of professional trust. FINACT Advisory &amp; Training operates as an extension of your finance function—delivering consistency, reliability, and clear communication across all engagements.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="finact-method" style="padding-top: 80px; padding-bottom: 80px;"> {{-- Reusing 'finact-method' for its full-width, centered text style --}}
        <div class="container">
            <div class="section-header" data-aos="fade-up" style="margin: 0;">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Your Remote Finance Partner</span>
                </div>
                <h2 class="section-title__title title-animation mb-4">
                    Connect <span>with Us</span>
                </h2>
                <p class="section-header__desc">
                    If you are looking to establish structured and dependable remote finance support, we are ready to assist.
                </p>
                <div class="banner-one__btn mt-4">
                    <a href="{{ route('frontend.contact.us') }}" class="thm-btn">Schedule a meeting
                        <span class="fas fa-arrow-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-out',
                    once: true,
                    offset: 50
                });
            }
        });
    </script>

@endsection
