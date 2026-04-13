<section class="finact-hero">
    <div class="finact-hero__bg">
        <div class="bg-shape bg-shape-1"></div>
        <div class="bg-shape bg-shape-2"></div>
        <div class="bg-shape bg-shape-3"></div>
    </div>

    <div class="container-fluid h-100">
        <div class="row align-items-center h-100">

            <!-- Left Side: Content -->
            <div class="col-xl-6 col-lg-7">
                <div class="finact-hero__content" data-aos="fade-right" data-aos-duration="1200">

                    <h1 class="finact-hero__title">
                        <span class="title-shimmer-wrap">
                            <span class="title-shimmer">FINACT — Where Precision Meets Excellence</span>
                        </span>
                    </h1>

                    <h2 class="finact-hero__subtitle">
                        Bringing
                        <span class="text-gradient-blue">Clarity</span>,
                        Control &
                        <span class="text-gradient-blue">Confidence</span>
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

                </div>
            </div>

            <!-- Right Side: Eye-Catching Finance Visual -->
            <div class="col-xl-6 col-lg-5 d-none d-lg-block">
                <div class="finact-hero__visual" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="300">

                    <!-- Central Glowing Ring -->
                    <div class="hero-ring-wrap">
                        <div class="hero-ring ring-outer"></div>
                        <div class="hero-ring ring-mid"></div>
                        <div class="hero-ring ring-inner"></div>

                        <!-- Center Icon -->
                        <div class="hero-center-badge">
                            <i class="fas fa-landmark"></i>
                            <span>FINACT</span>
                        </div>
                    </div>

                    <!-- Orbiting Stat Cards -->
                    <div class="orbit-card orbit-card--1 float-bob-y">
                        <div class="orbit-card__icon"><i class="fas fa-chart-line"></i></div>
                        <div>
                            <strong>Revenue Growth</strong>
                            <span>+24.8% YoY</span>
                        </div>
                    </div>

                    <div class="orbit-card orbit-card--2 float-bob-y-reverse">
                        <div class="orbit-card__icon orbit-card__icon--gold"><i class="fas fa-shield-alt"></i></div>
                        <div>
                            <strong>Compliance Rate</strong>
                            <span>100% Audit Ready</span>
                        </div>
                    </div>

                    <div class="orbit-card orbit-card--3 float-bob-y">
                        <div class="orbit-card__icon"><i class="fas fa-coins"></i></div>
                        <div>
                            <strong>Tax Savings</strong>
                            <span>Optimized Filing</span>
                        </div>
                    </div>

                    <div class="orbit-card orbit-card--4 float-bob-y-reverse">
                        <div class="orbit-card__icon orbit-card__icon--gold"><i class="fas fa-file-invoice-dollar"></i></div>
                        <div>
                            <strong>VAT Advisory</strong>
                            <span>NBR Approved</span>
                        </div>
                    </div>

                    <!-- Mini Bar Chart -->
                    <div class="hero-chart-mini float-bob-y">
                        <div class="hero-chart-mini__label">Financial Performance</div>
                        <div class="hero-chart-mini__bars">
                            <div class="hcm-bar" style="height:45%"><span>Q1</span></div>
                            <div class="hcm-bar" style="height:62%"><span>Q2</span></div>
                            <div class="hcm-bar" style="height:54%"><span>Q3</span></div>
                            <div class="hcm-bar hcm-bar--active" style="height:88%"><span>Q4</span></div>
                        </div>
                    </div>

                    <!-- Decorative Dashed Circle -->
                    <div class="glass-circle circle-1"></div>

                </div>
            </div>

        </div>
    </div>
</section>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --color-primary: #163355;
        --color-accent: #b89867;
        --color-light-bg: #ffffff;
        --color-text-body: #4b5563;
    }

    .finact-hero {
        position: relative;
        width: 100vw;
        height: 85vh;
        min-height: 620px;
        max-height: 820px;
        background: var(--color-light-bg);
        font-family: 'Plus Jakarta Sans', sans-serif;
        overflow: hidden;
        display: flex;
        align-items: center;
    }

    .finact-hero__bg {
        position: absolute;
        inset: 0;
        z-index: 1;
    }

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
        background: rgba(22, 51, 85, 0.08);
        top: -100px;
        right: -100px;
    }

    .bg-shape-2 {
        width: 400px;
        height: 400px;
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
    }

    .finact-hero .container-fluid {
        position: relative;
        z-index: 5;
        padding-left: 8%;
        padding-right: 5%;
    }

    /* ── Title shimmer animation (always moving) ── */
    .finact-hero__title {
        font-size: clamp(28px, 3.5vw, 46px);
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 18px;
        letter-spacing: -0.5px;
    }

    .title-shimmer-wrap {
        display: inline-block;
        position: relative;
        overflow: hidden;
    }

    .title-shimmer {
        display: inline-block;
        background: linear-gradient(270deg,
                #163355 0%,
                #163355 30%,
                #b89867 45%,
                #d4b070 50%,
                #b89867 55%,
                #163355 70%,
                #163355 100%);
        background-size: 300% 100%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: shimmerSlide 3s linear infinite;
    }

    @keyframes shimmerSlide {
        0% {
            background-position: 200% center;
        }

        100% {
            background-position: -200% center;
        }
    }

    .finact-hero__subtitle {
        font-size: clamp(18px, 2.2vw, 26px);
        font-weight: 700;
        line-height: 1.4;
        color: #475569;
        margin-bottom: 20px;
    }

    .text-gradient-blue {
        background: linear-gradient(135deg, #b89867 0%, #a3885c 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .finact-hero__text {
        font-size: clamp(15px, 1.3vw, 17px);
        line-height: 1.8;
        color: #64748b;
        max-width: 560px;
        margin-bottom: 32px;
        text-align: justify;
    }

    .finact-hero__buttons {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    .btn-finact {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 15px 30px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 15px;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-finact-primary {
        background: var(--color-primary);
        color: white;
        box-shadow: 0 10px 25px rgba(22, 51, 85, 0.2);
    }

    .btn-finact-primary:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 32px rgba(22, 51, 85, 0.3);
        background: #0f223a;
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
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    /* ── Right Side Visual ── */
    .finact-hero__visual {
        position: relative;
        height: 520px;
        width: 100%;
    }

    /* Rings */
    .hero-ring-wrap {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .hero-ring {
        position: absolute;
        top: 50%;
        left: 50%;
        border-radius: 50%;
        transform: translate(-50%, -50%);
        border: 2px dashed rgba(184, 152, 103, 0.3);
    }

    .ring-outer {
        width: 380px;
        height: 380px;
        animation: spin-cw 25s linear infinite;
        border-color: rgba(22, 51, 85, 0.12);
    }

    .ring-mid {
        width: 270px;
        height: 270px;
        animation: spin-ccw 18s linear infinite;
        border-color: rgba(184, 152, 103, 0.25);
    }

    .ring-inner {
        width: 160px;
        height: 160px;
        animation: spin-cw 12s linear infinite;
        border-color: rgba(22, 51, 85, 0.2);
        border-style: solid;
    }

    @keyframes spin-cw {
        to {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

    @keyframes spin-ccw {
        to {
            transform: translate(-50%, -50%) rotate(-360deg);
        }
    }

    /* Center badge */
    .hero-center-badge {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 110px;
        height: 110px;
        background: linear-gradient(135deg, #163355 0%, #1e4a7a 100%);
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
        box-shadow: 0 15px 40px rgba(22, 51, 85, 0.35);
        z-index: 10;
    }

    .hero-center-badge i {
        color: #b89867;
        font-size: 28px;
    }

    .hero-center-badge span {
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    /* Orbit cards */
    .orbit-card {
        position: absolute;
        background: #fff;
        border-radius: 14px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 10px 30px rgba(22, 51, 85, 0.10);
        border: 1px solid rgba(22, 51, 85, 0.07);
        z-index: 15;
        min-width: 185px;
    }

    .orbit-card__icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: linear-gradient(135deg, #163355 0%, #1e4a7a 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #b89867;
        font-size: 18px;
        flex-shrink: 0;
    }

    .orbit-card__icon--gold {
        background: linear-gradient(135deg, #b89867 0%, #d4b070 100%);
        color: #fff;
    }

    .orbit-card strong {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #163355;
        line-height: 1.2;
    }

    .orbit-card span {
        font-size: 11.5px;
        color: #64748b;
        font-weight: 500;
    }

    /* Card positions */
    .orbit-card--1 {
        top: 4%;
        left: 2%;
    }

    .orbit-card--2 {
        top: 4%;
        right: 2%;
    }

    .orbit-card--3 {
        bottom: 10%;
        left: 0%;
    }

    .orbit-card--4 {
        bottom: 10%;
        right: 0%;
    }

    /* Mini bar chart */
    .hero-chart-mini {
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        background: #fff;
        border-radius: 16px;
        padding: 16px 20px;
        box-shadow: 0 12px 35px rgba(22, 51, 85, 0.10);
        border: 1px solid rgba(22, 51, 85, 0.07);
        z-index: 15;
        width: 210px;
    }

    .hero-chart-mini__label {
        font-size: 11px;
        font-weight: 700;
        color: #163355;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 10px;
    }

    .hero-chart-mini__bars {
        display: flex;
        align-items: flex-end;
        gap: 8px;
        height: 60px;
    }

    .hcm-bar {
        flex: 1;
        background: rgba(22, 51, 85, 0.12);
        border-radius: 4px 4px 0 0;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding-bottom: 3px;
        transition: all 0.4s ease;
    }

    .hcm-bar--active {
        background: linear-gradient(to top, #163355, #2a5a9a);
    }

    .hcm-bar span {
        font-size: 9px;
        color: #888;
        font-weight: 600;
    }

    .hcm-bar--active span {
        color: #fff;
    }

    /* Decorative dashed circle */
    .glass-circle {
        position: absolute;
        border-radius: 50%;
        z-index: 1;
    }

    .circle-1 {
        width: 420px;
        height: 420px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 1.5px dashed rgba(184, 152, 103, 0.15);
    }

    /* Float animations */
    .float-bob-y {
        animation: float-y 5s infinite ease-in-out;
    }

    .float-bob-y-reverse {
        animation: float-y-reverse 5s infinite ease-in-out;
    }

    @keyframes float-y {

        0%,
        100% {
            transform: translateY(0)
        }

        50% {
            transform: translateY(-14px)
        }
    }

    @keyframes float-y-reverse {

        0%,
        100% {
            transform: translateY(0)
        }

        50% {
            transform: translateY(14px)
        }
    }

    /* ── Responsive ── */
    @media (max-width: 991px) {
        .finact-hero {
            height: auto;
            min-height: 560px;
            padding: 60px 0;
        }

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
