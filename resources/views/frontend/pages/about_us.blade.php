@extends('frontend.dashboard')
@section('frontend_title', 'About Us')

@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>About Us</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    {{-- Who We Are Section --}}
    <section class="who-we-are">
        <div class="floating-shape floating-shape-1"></div>
        <div class="floating-shape floating-shape-2"></div>
        <div class="floating-shape floating-shape-3"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="who-we-are__content" data-aos="fade-right">
                        <div class="section-title__tagline-box">
                            <span class="section-title__tagline">About FINACT</span>
                        </div>
                        <h2 class="section-title__title title-animation mb-4">
                            Who <span>We Are</span>
                        </h2>
                        <p class="who-we-are__text">
                            <strong>FINACT Advisory &amp; Training</strong> is a professional services practice focused on bridging the gap between technical complexity and practical business needs. We provide integrated support across advisory, tax and VAT, and corporate compliance, alongside capability development initiatives.
                        </p>
                        <p class="who-we-are__text">
                            We support entrepreneurs, investors, and organizations in building reliable financial foundations. Our objective is to promote disciplined financial practices that enable clarity, regulatory compliance, and sustainable business operations.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="who-we-are__image-wrapper" data-aos="fade-left">
                        <div class="who-we-are__image">
                            <img src="{{ asset('uploads/static_images/who_we_are.png') }}" alt="Who We Are">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Philosophy Section --}}
    <section class="who-we-are">
        <div class="floating-shape floating-shape-1"></div>
        <div class="floating-shape floating-shape-2"></div>
        <div class="floating-shape floating-shape-3"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="who-we-are__image-wrapper" data-aos="fade-left">
                        <div class="who-we-are__image">
                            <img src="{{ asset('uploads/static_images/our_philosophy.png') }}" alt="Who We Are">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="who-we-are__content" data-aos="fade-right">
                        <div class="section-title__tagline-box">
                            <span class="section-title__tagline">Our Philosophy</span>
                        </div>
                        <h2 class="section-title__title title-animation mb-4">
                            <span>Finance</span> is not merely a <span>record</span> of the <span>past</span>, it is the basis for informed <span>decisions</span>.
                        </h2>
                        <p class="philosophy__text">
                            A well-functioning finance system should go beyond compliance to support decision-making and operational control. Our approach emphasizes implementation-led solutions that align financial discipline with business objectives.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- What We Do Section --}}
    <section class="what-we-do">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Our Expertise</span>
                </div>
                <h2 class="section-title__title title-animation mb-4">
                    What We <span>Do</span>
                </h2>
                <p class="section-header__desc">We provide integrated support across core finance and compliance functions, including accounting, financial reporting, tax and VAT, regulatory compliance, and advisory services.</p>
                <br>
                <p class="section-header__desc">Our work focuses on helping organizations maintain accurate records, meet regulatory requirements, strengthen financial control, and use financial information to support effective decision-making.</p>
            </div>
            <div class="what-we-do__cards">
                <div class="what-we-do__card" data-aos="fade-up" data-aos-delay="100">
                    <div class="what-we-do__card-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h3 class="what-we-do__card-title">Accounting &amp; Financial Systems</h3>
                    <p class="what-we-do__card-text">Structured accounting and system support for accurate records and reliable reporting.</p>
                </div>
                <div class="what-we-do__card" data-aos="fade-up" data-aos-delay="200">
                    <div class="what-we-do__card-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="what-we-do__card-title">Strategic Advisory &amp; CFO Support</h3>
                    <p class="what-we-do__card-text">Financial insight and advisory support to strengthen control and decision-making.</p>
                </div>
                <div class="what-we-do__card" data-aos="fade-up" data-aos-delay="300">
                    <div class="what-we-do__card-icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <h3 class="what-we-do__card-title">Tax &amp; VAT Compliance</h3>
                    <p class="what-we-do__card-text">Practical solutions to manage tax, VAT, and regulatory compliance effectively.</p>
                </div>
                <div class="what-we-do__card" data-aos="fade-up" data-aos-delay="400">
                    <div class="what-we-do__card-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="what-we-do__card-title">Corporate &amp; Regulatory Affairs</h3>
                    <p class="what-we-do__card-text">End-to-end support for business setup, approvals, and statutory compliance.</p>
                </div>
                <div class="what-we-do__card" data-aos="fade-up" data-aos-delay="500">
                    <div class="what-we-do__card-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="what-we-do__card-title">Training &amp; Capability Development</h3>
                    <p class="what-we-do__card-text">Practical training programs to build financial and compliance capability.</p>
                </div>
                <div class="what-we-do__card" data-aos="fade-up" data-aos-delay="500">
                    <div class="what-we-do__card-icon">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                    <h3 class="what-we-do__card-title">Global Remote Finance Support</h3>
                    <p class="what-we-do__card-text">Reliable remote finance support for international clients with structured reporting and coordinated delivery.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Who We Serve Section --}}
    <section class="who-we-serve">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Our Clients</span>
                </div>
                <h2 class="section-title__title title-animation mb-4">
                    Who We <span>Serve</span>
                </h2>
                <p class="section-header__desc">We work with a diverse range of businesses and stakeholders, providing practical support tailored to their stage of growth, operational needs, and compliance requirements.</p>
            </div>
            <div class="who-we-serve__wrapper">
                <div class="who-we-serve__item" data-aos="fade-up" data-aos-delay="100">
                    <span class="who-we-serve__item-number">01</span>
                    <div class="who-we-serve__item-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h4 class="who-we-serve__item-title">Scaling SMEs</h4>
                    <p class="who-we-serve__item-text">Businesses seeking structured processes, improved control, and flexible CFO-level support for growth.</p>
                </div>
                <div class="who-we-serve__item" data-aos="fade-up" data-aos-delay="150">
                    <span class="who-we-serve__item-number">02</span>
                    <div class="who-we-serve__item-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h4 class="who-we-serve__item-title">High-Growth Startups</h4>
                    <p class="who-we-serve__item-text">Founders building disciplined, compliant, and investment-ready business foundations.</p>
                </div>
                <div class="who-we-serve__item" data-aos="fade-up" data-aos-delay="200">
                    <span class="who-we-serve__item-number">03</span>
                    <div class="who-we-serve__item-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h4 class="who-we-serve__item-title">Corporate Organizations</h4>
                    <p class="who-we-serve__item-text">Entities aiming to strengthen control, improve reporting quality, and maintain robust compliance frameworks.</p>
                </div>
                <div class="who-we-serve__item" data-aos="fade-up" data-aos-delay="250">
                    <span class="who-we-serve__item-number">04</span>
                    <div class="who-we-serve__item-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h4 class="who-we-serve__item-title">Foreign Investors</h4>
                    <p class="who-we-serve__item-text">Organizations establishing or expanding operations within Bangladesh, requiring reliable regulatory and operational support.</p>
                </div>
                <div class="who-we-serve__item" data-aos="fade-up" data-aos-delay="300">
                    <span class="who-we-serve__item-number">05</span>
                    <div class="who-we-serve__item-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h4 class="who-we-serve__item-title">International Partners</h4>
                    <p class="who-we-serve__item-text">Businesses seeking dependable remote support and cloud-based solutions to manage finance and compliance across locations.</p>
                </div>
                <div class="who-we-serve__item" data-aos="fade-up" data-aos-delay="300">
                    <span class="who-we-serve__item-number">06</span>
                    <div class="who-we-serve__item-icon">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <h4 class="who-we-serve__item-title">Special Assignments & Technical Support</h4>
                    <p class="who-we-serve__item-text">Focused support for special finance reviews, investigations, and assignment-based technical requirements requiring independent analysis, technical expertise, and disciplined execution.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FINACT Method Section --}}
    <section class="finact-method">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Our Approach</span>
                </div>
                <h2 class="section-title__title title-animation mb-4">
                    The <span>FINACT</span> Method
                </h2>
                <p class="section-header__desc">A Practical Approach to Structured Finance and Compliance. We follow a clear and structured approach to ensure reliable and effective financial operations.</p>
            </div>
            <div class="finact-method__timeline">
                <div class="finact-method__step" data-aos="fade-up">
                    <div class="finact-method__step-content">
                        <h3 class="finact-method__step-title">Assessment of Current Position</h3>
                        <p class="finact-method__step-text">Review of existing accounting records, reporting practices, and compliance status.</p>
                    </div>
                    <div class="finact-method__step-number">1</div>
                </div>
                <div class="finact-method__step" data-aos="fade-up">
                    <div class="finact-method__step-content">
                        <h3 class="finact-method__step-title">Identification of Gaps</h3>
                        <p class="finact-method__step-text">Identification of gaps, weaknesses, and areas requiring improvement in processes and controls.</p>
                    </div>
                    <div class="finact-method__step-number">2</div>
                </div>
                <div class="finact-method__step" data-aos="fade-up">
                    <div class="finact-method__step-content">
                        <h3 class="finact-method__step-title">Planning &amp; Structuring</h3>
                        <p class="finact-method__step-text">Development of a practical plan covering accounting processes, controls, reporting, and responsibilities.</p>
                    </div>
                    <div class="finact-method__step-number">3</div>
                </div>
                <div class="finact-method__step" data-aos="fade-up">
                    <div class="finact-method__step-content">
                        <h3 class="finact-method__step-title">Implementation &amp; Execution</h3>
                        <p class="finact-method__step-text">Execution of agreed processes with proper setup, coordination, and workflow alignment.</p>
                    </div>
                    <div class="finact-method__step-number">4</div>
                </div>
                <div class="finact-method__step" data-aos="fade-up">
                    <div class="finact-method__step-content">
                        <h3 class="finact-method__step-title">Review &amp; Monitoring</h3>
                        <p class="finact-method__step-text">Ongoing review of work, reporting accuracy, and process effectiveness.</p>
                    </div>
                    <div class="finact-method__step-number">5</div>
                </div>
                <div class="finact-method__step" data-aos="fade-up">
                    <div class="finact-method__step-content">
                        <h3 class="finact-method__step-title">Reporting &amp; Support</h3>
                        <p class="finact-method__step-text">Regular reporting, communication, and continuous support for improved financial management.</p>
                    </div>
                    <div class="finact-method__step-number">6</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Team Section --}}
    <section class="our-team">
        <div class="container">
            <div class="our-team__content" data-aos="fade-up">
                <div class="our-team__header">
                    <div class="our-team__icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="our-team__header-text">
                        <h2>Our <span>Team</span></h2>
                        <p>Experienced professionals delivering excellence in finance and compliance</p>
                    </div>
                </div>
                <p class="our-team__intro">
                    <strong>FINACT Advisory &amp; Training</strong> is supported by experienced professionals with strong technical capability and practical industry exposure across accounting, tax, VAT, and corporate governance. The structure combines strategic oversight with effective execution, ensuring each engagement is delivered with clarity, discipline, and professional accountability.
                </p>
                <br>
                <p class="our-team__intro">
                    A structured three-tier engagement model is followed. The Lead Consultant provides overall direction, oversees the engagement, and ensures quality and consistency in all deliverables. Senior Consultants and Consultants review work, validate outputs, and ensure alignment with regulatory and business requirements. Associates focus on detailed execution, including analysis, identifying gaps, and developing practical, actionable solutions. This approach ensures both depth of insight and reliability in outcomes.
                </p>
                <br>
                <p class="our-team__intro">
                    Strong exposure to the Pharmaceutical and Manufacturing sectors is a key strength. Consultants bring significant industry exposure, with senior members having over 20 years of experience within leading pharmaceutical organizations, including hands-on involvement in financial reporting, product costing, regulatory compliance, and operational finance, including complex tax and VAT matters. Associates bring relevant professional experience and are actively involved in execution, analysis, and process support. This provides a grounded understanding of how finance functions operate in compliance-driven environments where accuracy, control, and regulatory alignment are critical.
                </p>
                <br>
                <p class="our-team__intro">
                    Experience gained from leading audit firms contributes structured thinking, technical discipline, and familiarity with statutory audits and financial reporting standards. Practical exposure to regulatory environments such as BIDA and RJSC supports effective handling of compliance requirements within real operational contexts.
                </p>
                <br>
                <p class="our-team__intro">
                    Experience with enterprise platforms such as SAP (including S/4HANA) supports advisory roles during implementation, particularly within the FICO module, with focus on design alignment and process integration. For operational execution, cloud-based platforms such as QuickBooks and Xero are utilized where appropriate, enabling efficient workflows, improved visibility, and structured operations. The overall approach emphasizes practical implementation—ensuring that processes, controls, and frameworks are effectively applied and consistently maintained in day-to-day operations.
                </p>

                {{-- Team Composition --}}
                <div class="our-team__composition" data-aos="fade-up">
                    <h3 class="our-team__composition-title">Team Composition</h3>
                    <p class="our-team__composition-intro">Our multidisciplinary team includes:</p>
                    <ul class="our-team__composition-list">
                        <li><i class="fas fa-check-circle"></i> Chartered Accountants (CA)</li>
                        <li><i class="fas fa-check-circle"></i> Chartered Secretaries (CS)</li>
                        <li><i class="fas fa-check-circle"></i> Part-Qualified Chartered Accountants</li>
                        <li><i class="fas fa-check-circle"></i> Panel of Advocates</li>
                        <li><i class="fas fa-check-circle"></i> Income Tax Practitioners (ITP)</li>
                        <li><i class="fas fa-check-circle"></i> NBR-Approved VAT Consultants</li>
                        <li><i class="fas fa-check-circle"></i> BBA and MBA Graduates from Reputed Universities</li>
                    </ul>
                    <p class="our-team__composition-closing">
                        This diverse professional combination enables <strong>FINACT</strong> to deliver practical, reliable, and well-coordinated solutions across finance, compliance, regulatory, and advisory engagements.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- Vision, Mission & Core Values Section --}}
    <section class="vision-mission">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline" style="color:#b89867;">What Drives Us</span>
                </div>
                <h2 class="section-header__title">
                    Vision, Mission &amp; Core Values
                </h2>
            </div>
            <div class="vision-mission__tabs" data-aos="fade-up">
                <button class="vision-mission__tab active" onclick="showPanel('vision', this)">
                    <i class="fas fa-eye"></i> Vision
                </button>
                <button class="vision-mission__tab" onclick="showPanel('mission', this)">
                    <i class="fas fa-bullseye"></i> Mission
                </button>
                <button class="vision-mission__tab" onclick="showPanel('values', this)">
                    <i class="fas fa-heart"></i> Core Values
                </button>
            </div>
            <div class="vision-mission__content" data-aos="fade-up">
                <div id="vision" class="vision-mission__panel active">
                    <div class="vision-mission__panel-header">
                        <div class="vision-mission__panel-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="vision-mission__panel-title">Our Vision</h3>
                    </div>
                    <p class="vision-mission__panel-text">
                        To be a trusted finance and compliance partner, enabling businesses to operate with clarity, control, and confidence.
                    </p>
                </div>
                <div id="mission" class="vision-mission__panel">
                    <div class="vision-mission__panel-header">
                        <div class="vision-mission__panel-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 class="vision-mission__panel-title">Our Mission</h3>
                    </div>
                    <ul class="vision-mission__list">
                        <li>
                            <div class="vision-mission__list-icon"><i class="fas fa-check"></i></div>
                            <p class="vision-mission__list-text">Deliver accurate and reliable accounting, tax, and advisory services.</p>
                        </li>
                        <li>
                            <div class="vision-mission__list-icon"><i class="fas fa-check"></i></div>
                            <p class="vision-mission__list-text">Support businesses with structured and secure finance operations, including remote capabilities.</p>
                        </li>
                        <li>
                            <div class="vision-mission__list-icon"><i class="fas fa-check"></i></div>
                            <p class="vision-mission__list-text">Build long-term relationships through consistent, quality-driven service delivery.</p>
                        </li>
                        <li>
                            <div class="vision-mission__list-icon"><i class="fas fa-check"></i></div>
                            <p class="vision-mission__list-text">Develop practical skills through implementation-focused training and professional development.</p>
                        </li>
                    </ul>
                </div>
                <div id="values" class="vision-mission__panel">
                    <div class="vision-mission__panel-header">
                        <div class="vision-mission__panel-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="vision-mission__panel-title">Our Core Values</h3>
                    </div>
                    <ul class="vision-mission__list">
                        <li>
                            <div class="vision-mission__list-icon"><i class="fas fa-check"></i></div>
                            <p class="vision-mission__list-text"><strong>Integrity:</strong> Maintaining professional ethics, independence, and transparency in every engagement.</p>
                        </li>
                        <li>
                            <div class="vision-mission__list-icon"><i class="fas fa-check"></i></div>
                            <p class="vision-mission__list-text"><strong>Accuracy:</strong> Ensuring precision, consistency, and compliance in all financial work.</p>
                        </li>
                        <li>
                            <div class="vision-mission__list-icon"><i class="fas fa-check"></i></div>
                            <p class="vision-mission__list-text"><strong>Implementation:</strong> Delivering practical, structured, and sustainable solutions.</p>
                        </li>
                        <li>
                            <div class="vision-mission__list-icon"><i class="fas fa-check"></i></div>
                            <p class="vision-mission__list-text"><strong>Accountability:</strong> Committing to reliable delivery and professional responsibility.</p>
                        </li>
                        <li>
                            <div class="vision-mission__list-icon"><i class="fas fa-check"></i></div>
                            <p class="vision-mission__list-text"><strong>Client Focus:</strong> Aligning services with the specific needs and context of each client.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Technology & Data Security Section --}}
    <section class="philosophy-section">
        <div class="container">
            <div class="philosophy__content" data-aos="fade-up">
                <div class="philosophy__icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Technology & Data Security</span>
                </div>
                <h2 class="section-title__title title-animation mb-4">
                    <span>Technology</span> &amp; Data Security
                </h2>
                <p class="philosophy__text">
                    Financial information today must be both accessible and securely managed. FINACT supports the use of cloud-based accounting platforms such as QuickBooks and Xero, where appropriate, based on client requirements and operational needs.
                </p>
                <br>
                <p class="philosophy__text">
                    We assist in the implementation and effective use of these systems to improve financial visibility, reporting, and process efficiency, particularly in remote and multi-location environments.
                </p>
                <br>
                <p class="philosophy__text">
                    A strong focus is maintained on data confidentiality, integrity, and controlled access. Finance processes—whether delivered locally or remotely—are structured to ensure secure handling of financial information in line with accepted professional practices.
                </p>
                <div class="philosophy__divider"></div>
            </div>
        </div>
    </section>

    {{-- Strategic Direction Section --}}
    <section class="technology-section">
        <div class="container">
            <div class="technology__wrapper">
                <div class="technology__content" data-aos="fade-left">
                    <div class="section-title__tagline-box">
                        <span class="section-title__tagline">Looking Forward</span>
                    </div>
                    <h2 class="section-title__title title-animation">
                        Our <span>Strategic</span> Direction
                    </h2>
                    <p class="strategic-direction__text">
                        <strong>FINACT Advisory &amp; Training</strong> is focused on strengthening finance functions through structured systems, disciplined processes, and improved financial visibility.
                    </p>
                    <p class="strategic-direction__text">
                        The firm promotes the adoption of system-based financial management and standardized workflows where they enhance control, reporting quality, and decision support.
                    </p>
                    <p class="strategic-direction__text">
                        At the same time, <strong>FINACT</strong> maintains a pragmatic approach—adapting to the operational realities of each business and ensuring reliable, compliant, and well-structured financial practices across all engagements.
                    </p>
                    <p class="strategic-direction__text">
                        Its strategic direction is centered on applying structured methods and appropriate technology where they add value, while maintaining consistency, quality, and professional integrity in all circumstances.
                    </p>
                </div>
                <div class="technology__image" data-aos="fade-right">
                    <div class="technology__image-main">
                        <img src="{{ asset('uploads/static_images/strategic_direction.jpg') }}" alt="Strategic Direction">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Tab functionality for Vision/Mission/Values
        function showPanel(panelId, clickedTab) {
            // Remove active class from all tabs
            document.querySelectorAll('.vision-mission__tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // Remove active class from all panels
            document.querySelectorAll('.vision-mission__panel').forEach(panel => {
                panel.classList.remove('active');
            });

            // Add active class to clicked tab
            clickedTab.classList.add('active');

            // Add active class to corresponding panel
            document.getElementById(panelId).classList.add('active');
        }

        // Initialize AOS if available
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
