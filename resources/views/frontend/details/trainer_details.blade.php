@extends('frontend.dashboard')
@section('frontend_title', $trainer->meta_title ?? $trainer->name)

@section('frontend_content')

    <style>
        .trp-wrap {
            padding: 55px 0 75px;
            background: #f8f9fc;
        }

        .trp-hero {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 2px 18px rgba(22, 51, 85, 0.09);
            overflow: hidden;
            margin-bottom: 22px;
        }

        .trp-hero__banner {
            height: 110px;
            background: linear-gradient(135deg, #163355 0%, #1e4a7a 60%, #b89867 100%);
            position: relative;
        }

        .trp-hero__banner::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40px;
            background: #ffffff;
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        }

        .trp-hero__avatar-wrap {
            display: flex;
            justify-content: center;
            margin-top: -52px;
            position: relative;
            z-index: 2;
        }

        .trp-hero__avatar {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #ffffff;
            box-shadow: 0 4px 16px rgba(22, 51, 85, 0.15);
        }

        .trp-hero__avatar-placeholder {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            background: #163355;
            border: 4px solid #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            font-weight: 700;
            color: #d4b896;
            box-shadow: 0 4px 16px rgba(22, 51, 85, 0.15);
        }

        .trp-hero__body {
            text-align: center;
            padding: 10px 20px 20px;
        }

        .trp-hero__name {
            font-size: 19px;
            font-weight: 700;
            color: #163355;
            margin: 0 0 4px;
        }

        .trp-hero__desig {
            font-size: 13px;
            color: #6b7280;
            margin: 0 0 10px;
        }

        .trp-hero__badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 4px;
        }

        .trp-hero__badge.active {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .trp-hero__badge.inactive {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .trp-hero__badge .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .trp-stats {
            display: flex;
            border-top: 1px solid #f0f0f0;
            margin-top: 4px;
        }

        .trp-stat {
            flex: 1;
            padding: 12px 8px;
            text-align: center;
            border-right: 1px solid #f0f0f0;
        }

        .trp-stat:last-child {
            border-right: none;
        }

        .trp-stat__icon {
            font-size: 16px;
            color: #b89867;
            margin-bottom: 4px;
        }

        .trp-stat__val {
            font-size: 15px;
            font-weight: 700;
            color: #163355;
            display: block;
        }

        .trp-stat__lbl {
            font-size: 10px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: block;
        }

        /* Courses Card */
        .trp-courses-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 14px rgba(22, 51, 85, 0.08);
            overflow: hidden;
            margin-bottom: 22px;
        }

        .trp-card-header {
            background: #163355;
            padding: 11px 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .trp-card-header i {
            color: #d4b896;
            font-size: 13px;
        }

        .trp-card-header h4 {
            color: #d4b896;
            font-size: 14px;
            font-weight: 700;
            margin: 0;
        }

        .trp-card-body {
            padding: 6px 0;
        }

        .trp-course-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            border-bottom: 1px solid #f3f4f6;
            text-decoration: none;
            transition: background 0.2s;
        }

        .trp-course-item:last-child {
            border-bottom: none;
        }

        .trp-course-item:hover {
            background: #f8f9fc;
            text-decoration: none;
        }

        .trp-course-num {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #eef3fb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: #163355;
            flex-shrink: 0;
            transition: background 0.2s, color 0.2s;
        }

        .trp-course-item:hover .trp-course-num {
            background: #163355;
            color: #d4b896;
        }

        .trp-course-title {
            font-size: 13px;
            font-weight: 600;
            color: #163355;
            line-height: 1.35;
            flex: 1;
            transition: color 0.2s;
        }

        .trp-course-item:hover .trp-course-title {
            color: #b89867;
        }

        .trp-course-arrow {
            font-size: 11px;
            color: #c4cdd8;
            flex-shrink: 0;
        }

        /* About Card */
        .trp-about-card {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 2px 18px rgba(22, 51, 85, 0.09);
            overflow: hidden;
        }

        .trp-about-top {
            background: linear-gradient(135deg, #163355 0%, #1e4a7a 100%);
            padding: 24px 28px;
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .trp-about-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: rgba(212, 184, 150, 0.2);
            border: 2px solid rgba(212, 184, 150, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .trp-about-icon-wrap i {
            font-size: 22px;
            color: #d4b896;
        }

        .trp-about-top h2 {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            margin: 0 0 3px;
        }

        .trp-about-top p {
            font-size: 13px;
            color: rgba(212, 184, 150, 0.85);
            margin: 0;
        }

        .trp-about-body {
            padding: 26px 28px;
            font-size: 15px;
            color: #4b5563;
            line-height: 1.75;
        }

        .trp-about-body p {
            margin-bottom: 14px;
        }

        .trp-about-body h3,
        .trp-about-body h4 {
            color: #163355;
            margin: 20px 0 8px;
        }

        .trp-about-body ul {
            padding-left: 20px;
            margin-bottom: 14px;
        }

        .trp-about-body ul li {
            margin-bottom: 6px;
        }

        .trp-no-desc {
            padding: 40px 28px;
            text-align: center;
            color: #9ca3af;
        }

        .trp-no-desc i {
            font-size: 38px;
            color: #d1d5db;
            display: block;
            margin-bottom: 12px;
        }

        @media (max-width: 991px) {
            .trp-about-top {
                padding: 18px 20px;
            }

            .trp-about-body {
                padding: 20px;
            }

            .trp-about-top h2 {
                font-size: 17px;
            }
        }
    </style>

    <!--Page Header-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Trainer Profile</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li><a href="{{ route('frontend.training.development') }}">Training</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>{{ $trainer->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="trp-wrap">
        <div class="container">
            <div class="row">

                {{-- ── LEFT SIDEBAR ── --}}
                <div class="col-lg-4 mb-4 mb-lg-0">

                    {{-- Hero Profile Card --}}
                    <div class="trp-hero">
                        <div class="trp-hero__banner"></div>

                        <div class="trp-hero__avatar-wrap">
                            @if ($trainer->trainer_image)
                                <img class="trp-hero__avatar" src="{{ asset($trainer->trainer_image) }}" alt="{{ $trainer->name }}">
                            @else
                                <div class="trp-hero__avatar-placeholder">
                                    {{ strtoupper(substr($trainer->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <div class="trp-hero__body">
                            <h2 class="trp-hero__name">{{ $trainer->name }}</h2>
                            @if ($trainer->designation)
                                <p class="trp-hero__desig">{{ $trainer->designation }}</p>
                            @endif
                            <span class="trp-hero__badge {{ $trainer->status }}">
                                <span class="dot"></span>
                                {{ ucfirst($trainer->status) }}
                            </span>
                        </div>

                        <div class="trp-stats">
                            @if ($trainer->no_of_experience)
                                <div class="trp-stat">
                                    <div class="trp-stat__icon">
                                        <i class="fa fa-briefcase"></i>
                                    </div>
                                    <span class="trp-stat__val">{{ $trainer->no_of_experience }}</span>
                                    <span class="trp-stat__lbl">Experience</span>
                                </div>
                            @endif
                            @if ($trainings->count())
                                <div class="trp-stat">
                                    <div class="trp-stat__icon">
                                        <i class="fa fa-book-open"></i>
                                    </div>
                                    <span class="trp-stat__val">{{ $trainings->count() }}</span>
                                    <span class="trp-stat__lbl">Courses</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Training Courses Card --}}
                    @if ($trainings->count())
                        <div class="trp-courses-card">
                            <div class="trp-card-header">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <h4>Training Courses</h4>
                            </div>
                            <div class="trp-card-body">
                                @foreach ($trainings as $i => $tr)
                                    <a href="{{ route('frontend.training.development.details', $tr->slug) }}" class="trp-course-item">
                                        <div class="trp-course-num">{{ $i + 1 }}</div>
                                        <span class="trp-course-title">{{ $tr->title }}</span>
                                        <i class="fas fa-chevron-right trp-course-arrow"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                {{-- ── RIGHT: ABOUT ── --}}
                <div class="col-lg-8">
                    <div class="trp-about-card">

                        <div class="trp-about-top">
                            <div class="trp-about-icon-wrap">
                                <i class="fa fa-user-tie"></i>
                            </div>
                            <div>
                                <h2>About {{ $trainer->name }}</h2>
                                @if ($trainer->designation)
                                    <p>{{ $trainer->designation }}</p>
                                @endif
                            </div>
                        </div>

                        @if ($trainer->description)
                            <div class="trp-about-body">
                                {!! $trainer->description !!}
                            </div>
                        @else
                            <div class="trp-no-desc">
                                <i class="fa-regular fa-file-lines"></i>
                                <p>No details available for this trainer yet.</p>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
