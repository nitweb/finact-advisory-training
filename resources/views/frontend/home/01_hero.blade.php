<section class="finact-hero">
    <!-- Full Width AI/Motion Background -->
    <div class="finact-hero__bg">
        <div class="bg-shape bg-shape-1"></div>
        <div class="bg-shape bg-shape-2"></div>
        <div class="bg-shape bg-shape-3"></div>
        <!-- Place your AI Generated Accounting Light Mesh Image Here -->
        <img src="{{ asset('uploads/static_images/hero_section.png') }}" alt="AI Finance background" class="finact-hero__bg-img">
    </div>

    <div class="container-fluid h-100">
        <div class="row align-items-center h-100">

            <!-- Left Side: Content -->
            <div class="col-xl-6 col-lg-7">
                <div class="finact-hero__content" data-aos="fade-right" data-aos-duration="1200">

                    <div class="finact-hero__badge">
                        <span class="pulse-dot"></span> Modern Accounting & Finance
                    </div>

                    <h1 class="finact-hero__title">
                        FINACT — Where
                        <span class="text-gradient-gold blink-gold">Precision</span> <br>
                        Meets
                        <span class="text-gradient-gold blink-gold">Excellence</span>.
                    </h1>

                    <h2 class="finact-hero__subtitle">
                        Bringing
                        <span class="text-gradient-blue pulse-grow">Clarity</span>,
                        Control &
                        <span class="text-gradient-blue pulse-grow">Confidence</span>
                        to Your Finance
                    </h2>

                    <p class="finact-hero__text">
                        We help businesses build disciplined financial processes, strengthen internal controls, and use financial information to support both daily operations and long-term decisions.
                    </p>

                    <div class="finact-hero__buttons">
                        <a href="{{ route('frontend.contact.us') }}" class="btn-finact btn-finact-primary">
                            <span>Schedule a Consultation</span>
                            <i class="fas fa-calendar-check"></i>
                        </a>
                        <a href="{{ route('frontend.all.services.list') }}" class="btn-finact btn-finact-secondary">
                            <span>View Our Services</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <div class="finact-hero__trust">
                        <div class="trust-item"><i class="fas fa-shield-halved"></i> Bank-Level Security</div>
                        <div class="trust-item"><i class="fas fa-chart-line"></i> Real-time Analytics</div>
                        <div class="trust-item"><i class="fas fa-check-circle"></i> ISO Certified</div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Eye-catching Abstract AI & Data Graphics (No Humans) -->
            <div class="col-xl-6 col-lg-5 d-none d-lg-block">
                <div class="finact-hero__visual" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="300">

                    <!-- Glassmorphism Main Chart Card -->
                    <div class="glass-card main-stats float-bob-y">
                        <div class="card-header-glass">
                            <span>Financial Growth Metrics</span>
                            <span class="badge-success">+24.8%</span>
                        </div>
                        <div class="chart-visual">
                            <div class="bar" style="height: 40%"></div>
                            <div class="bar" style="height: 60%"></div>
                            <div class="bar" style="height: 50%"></div>
                            <div class="bar" style="height: 90%"></div>
                            <div class="bar active" style="height: 75%"></div>
                        </div>
                    </div>

                    <!-- Floating 3D Elements -->
                    <div class="floating-element element-coin float-bob-y">
                        <img src="{{ asset('uploads/static_images/gold-coin.png') }}" alt="Gold Coin" class="rotate-me" style="width: 100px;">
                    </div>

                    <div class="floating-element element-pie float-bob-x">
                        <i class="fas fa-chart-pie"></i>
                    </div>

                    <div class="floating-element element-calc float-bob-y">
                        <i class="fas fa-calculator"></i>
                    </div>

                    <div class="floating-element element-report float-bob-y-reverse">
                        <div class="report-content">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <div>
                                <strong>Audit Ready</strong>
                                <span>Verification Passed</span>
                            </div>
                        </div>
                    </div>

                    <div class="glass-circle circle-1"></div>
                    <div class="glass-circle circle-2"></div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    /* ==========================================================================
     FINACT PREMIUM FULL-WIDTH HERO SECTION - REDESIGNED
     ========================================================================== */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    /* Palette Variables */
    :root {
        --color-primary: #163355;
        /* Deep Navy */
        --color-accent: #b89867;
        /* Muted Gold */
        --color-light-bg: #ffffff;
        --color-text-body: #4b5563;
        --color-border: rgba(22, 51, 85, 0.1);
    }

    .finact-hero {
        position: relative;
        width: 100vw;
        height: 100vh;
        min-height: 800px;
        background: var(--color-light-bg);
        font-family: 'Plus Jakarta Sans', sans-serif;
        overflow: hidden;
        display: flex;
        align-items: center;
    }

    /* Full Width Background Layer */
    .finact-hero__bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .finact-hero__bg-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.15;
        mix-blend-mode: multiply;
    }

    /* LIGHT Blurred Background Shapes (Updated for Light Theme) */
    .bg-shape {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        z-index: 1;
        opacity: 0.6;
    }

    .bg-shape-1 {
        width: 500px;
        height: 500px;
        /* Tinted Light Blue using RGBA for softness */
        background: rgba(22, 51, 85, 0.08);
        top: -100px;
        right: -100px;
    }

    .bg-shape-2 {
        width: 400px;
        height: 400px;
        /* Tinted Warm Beige */
        background: rgba(184, 152, 103, 0.15);
        bottom: -100px;
        left: 20%;
    }

    .bg-shape-3 {
        width: 600px;
        height: 600px;
        background: rgba(255, 255, 255, 1);
        top: 30%;
        right: 30%;
        mix-blend-mode: overlay;
        /* Softens against other shapes */
    }

    /* Content Area inside Container */
    .finact-hero .container-fluid {
        position: relative;
        z-index: 5;
        padding-left: 8%;
        padding-right: 8%;
    }

    /* Updated Badge Styles */
    .finact-hero__badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(184, 152, 103, 0.1);
        /* Light Gold Tint */
        color: var(--color-primary);
        padding: 8px 16px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 14px;
        border: 1px solid rgba(184, 152, 103, 0.3);
        margin-bottom: 25px;
    }

    .pulse-dot {
        width: 8px;
        height: 8px;
        background-color: var(--color-accent);
        border-radius: 50%;
        display: inline-block;
        animation: pulse-dot-anime 1.5s infinite;
    }

    @keyframes pulse-dot-anime {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(184, 152, 103, 0.7);
        }

        70% {
            transform: scale(1);
            box-shadow: 0 0 0 10px rgba(184, 152, 103, 0);
        }

        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(184, 152, 103, 0);
        }
    }

    .finact-hero__title {
        font-size: 45px;
        font-weight: 800;
        line-height: 1.2;
        color: var(--color-primary);
        /* Navy Headlines */
        margin-bottom: 15px;
        letter-spacing: -1px;
    }

    .finact-hero__subtitle {
        font-size: clamp(24px, 3vw, 32px);
        font-weight: 700;
        line-height: 1.3;
        color: #475569;
        margin-bottom: 25px;
    }

    /* Typography Gradients */
    .text-gradient-gold {
        background: linear-gradient(135deg, #b89867 0%, #a3885c 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .text-gradient-blue {
        background: linear-gradient(135deg, #b89867 0%, #a3885c 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Animation for Gold Text */
    .blink-gold {
        animation: textGlowGold 3s infinite alternate;
    }

    @keyframes textGlowGold {
        0% {
            filter: drop-shadow(0 0 0px rgba(184, 152, 103, 0.2));
        }

        50% {
            filter: drop-shadow(0 0 10px rgba(184, 152, 103, 0.4));
            opacity: 0.9;
        }

        100% {
            filter: drop-shadow(0 0 0px rgba(184, 152, 103, 0.2));
        }
    }

    .pulse-grow {
        display: inline-block;
        animation: textPulse 3s infinite ease-in-out;
    }

    @keyframes textPulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.03);
        }
    }

    .finact-hero__text {
        font-size: clamp(16px, 1.5vw, 18px);
        line-height: 1.8;
        color: #64748b;
        max-width: 600px;
        margin-bottom: 40px;
    }

    /* Buttons - Updated Colors */
    .finact-hero__buttons {
        display: flex;
        gap: 20px;
        margin-bottom: 50px;
    }

    .btn-finact {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 18px 36px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 16px;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-finact-primary {
        background: var(--color-primary);
        /* Navy Button */
        color: white;
        box-shadow: 0 10px 25px rgba(22, 51, 85, 0.2);
    }

    .btn-finact-primary:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 35px rgba(22, 51, 85, 0.3);
        background: #0f223a;
        /* Slightly darker navy on hover */
        color: white;
    }

    .btn-finact-secondary {
        background: white;
        color: var(--color-primary);
        border: 2px solid #e2e8f0;
    }

    .btn-finact-secondary:hover {
        background: #fdfdfd;
        border-color: var(--color-accent);
        color: var(--color-primary);
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    /* Trust Elements */
    .finact-hero__trust {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
    }

    .trust-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #475569;
        font-weight: 600;
    }

    /* Change checkmark colors to accent */
    .trust-item i {
        color: var(--color-accent);
        /* Gold checks */
        font-size: 16px;
    }

    /* Right Side Abstract Visual Display */
    .finact-hero__visual {
        position: relative;
        height: 600px;
        width: 100%;
    }

    .glass-card {
        position: absolute;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(22, 51, 85, 0.05);
        /* Very subtle navy border */
        border-radius: 24px;
        box-shadow: 0 20px 50px rgba(22, 51, 85, 0.05);
        z-index: 10;
        padding: 24px;
    }

    .main-stats {
        width: 420px;
        height: 280px;
        top: 15%;
        left: 10%;
    }

    .card-header-glass {
        display: flex;
        justify-content: space-between;
        font-weight: 700;
        color: var(--color-primary);
        margin-bottom: 30px;
        font-size: 16px;
    }

    .badge-success {
        background: rgba(184, 152, 103, 0.15);
        color: var(--color-primary);
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        border: 1px solid rgba(184, 152, 103, 0.2);
    }

    .chart-visual {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        height: 140px;
    }

    .chart-visual .bar {
        width: 40px;
        background: #e2e8f0;
        border-radius: 8px;
        transition: all 0.5s ease;
    }

    .chart-visual .bar.active {
        /* Gradient from Navy to Lighter Navy */
        background: linear-gradient(to top, #163355, #3b6fa8);
    }

    .floating-element {
        position: absolute;
        z-index: 15;
        background: white;
        box-shadow: 0 10px 30px rgba(22, 51, 85, 0.06);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
    }

    .element-pie {
        width: 70px;
        height: 70px;
        top: 5%;
        right: 20%;
        color: var(--color-accent);
        /* Gold Icon */
        font-size: 28px;
        border: 1px solid rgba(184, 152, 103, 0.2);
    }

    .element-calc {
        width: 80px;
        height: 80px;
        bottom: 10%;
        left: 15%;
        color: var(--color-primary);
        /* Navy Icon */
        font-size: 32px;
    }

    .element-report {
        width: 250px;
        height: 80px;
        bottom: 25%;
        right: 5%;
        background: rgba(255, 255, 255, 0.95);
        padding: 15px;
        border-left: 4px solid var(--color-accent);
    }

    .report-content {
        display: flex;
        align-items: center;
        gap: 15px;
        width: 100%;
    }

    .report-content i {
        font-size: 30px;
        color: var(--color-primary);
        /* Navy Icon */
    }

    .report-content div {
        display: flex;
        flex-direction: column;
    }

    .report-content strong {
        color: var(--color-primary);
        font-size: 14px;
    }

    .report-content span {
        color: #64748b;
        font-size: 12px;
    }

    .glass-circle {
        position: absolute;
        border-radius: 50%;
        border: 1px solid rgba(184, 152, 103, 0.15);
        z-index: 1;
    }

    .circle-1 {
        width: 350px;
        height: 350px;
        top: 5%;
        right: 15%;
        border: 2px dashed rgba(184, 152, 103, 0.3);
        animation: rotate-ani 20s infinite linear reverse;
    }

    .circle-2 {
        width: 200px;
        height: 200px;
        bottom: 5%;
        left: 30%;
        opacity: 0.5;
        box-shadow: 0 0 20px rgba(184, 152, 103, 0.1);
    }

    /* Animations */
    .float-bob-y {
        animation: float-y 5s infinite ease-in-out;
    }

    .float-bob-y-reverse {
        animation: float-y-reverse 5s infinite ease-in-out;
    }

    .float-bob-x {
        animation: float-x 6s infinite ease-in-out;
    }

    .rotate-me {
        animation: rotate-ani 15s infinite linear;
    }

    @keyframes float-y {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    @keyframes float-y-reverse {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(20px);
        }
    }

    @keyframes float-x {

        0%,
        100% {
            transform: translateX(0);
        }

        50% {
            transform: translateX(-20px);
        }
    }

    @keyframes rotate-ani {
        100% {
            transform: rotate(360deg);
        }
    }

    /* Responsive Overrides */
    @media (max-width: 991px) {
        .finact-hero .container-fluid {
            padding-left: 5%;
            padding-right: 5%;
        }

        .finact-hero__buttons {
            flex-direction: column;
        }

        .btn-finact {
            width: 100%;
            justify-content: center;
        }
    }
</style>
