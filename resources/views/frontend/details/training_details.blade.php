@extends('frontend.dashboard')
@section('frontend_title', $training_details->meta_title ?? $training_details->title)

@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>{{ Str::limit($training_details->title, 50) }}</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li><a href="{{ route('frontend.training.development') }}">Training & Development</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>{{ Str::limit($training_details->title, 30) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <div class="td-wrap">
        <div class="container">
            <div class="row">

                {{-- ── SIDEBAR ── --}}
                <div class="col-lg-4 col-xl-4 mb-4 mb-lg-0">

                    {{-- Course Overview Card --}}
                    <div class="td-overview-card">

                        <div class="td-overview-header">
                            <h4>Course Overview</h4>
                            @if ($training_details->course_start)
                                <div class="td-overview-date">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ \Carbon\Carbon::parse($training_details->course_start)->format('M d, Y') }}
                                </div>
                            @endif
                        </div>

                        <div class="td-overview-body">

                            {{-- Info Grid --}}
                            <div class="td-info-grid">
                                @if ($training_details->type)
                                    <div class="td-info-cell">
                                        <span class="td-info-lbl">Type</span>
                                        <span class="td-info-val">{{ ucfirst($training_details->type) }}</span>
                                    </div>
                                @endif
                                @if ($training_details->certification)
                                    <div class="td-info-cell">
                                        <span class="td-info-lbl">Certification</span>
                                        <span class="td-info-val">{{ $training_details->certification }}</span>
                                    </div>
                                @endif
                                @if ($training_details->no_of_classes)
                                    <div class="td-info-cell">
                                        <span class="td-info-lbl">Classes</span>
                                        <span class="td-info-val">{{ $training_details->no_of_classes }}</span>
                                    </div>
                                @endif
                                @if ($training_details->duration)
                                    <div class="td-info-cell">
                                        <span class="td-info-lbl">Duration</span>
                                        <span class="td-info-val">{{ $training_details->duration }} hrs</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Deadline --}}
                            @if ($training_details->registration_deadline)
                                <div class="td-deadline-row">
                                    <i class="far fa-clock"></i>
                                    <div>
                                        <span class="td-deadline-lbl">Registration Deadline</span>
                                        <span class="td-deadline-val">
                                            {{ \Carbon\Carbon::parse($training_details->registration_deadline)->format('d M, Y') }}
                                        </span>
                                    </div>
                                </div>
                            @endif

                            {{-- Fee --}}
                            @if ($training_details->regular_fee || $training_details->registration_fee)
                                <div class="td-fee-box">
                                    <div class="td-fee-half">
                                        <span class="td-fee-lbl">Regular Fee</span>
                                        @if ($training_details->regular_fee)
                                            <span class="td-fee-reg">৳ {{ number_format($training_details->regular_fee) }}</span>
                                        @else
                                            <span class="td-fee-main">—</span>
                                        @endif
                                    </div>
                                    <div class="td-fee-half">
                                        <span class="td-fee-lbl">Registration Fee</span>
                                        <span class="td-fee-main">
                                            {{ $training_details->registration_fee ? '৳ ' . number_format($training_details->registration_fee) : '—' }}
                                        </span>
                                    </div>
                                </div>
                            @endif

                            {{-- Enroll --}}
                            <a href="{{ route('frontend.training.enroll', $training_details->slug) }}" class="td-enroll-btn">
                                Enroll Now <i class="fas fa-arrow-right" style="font-size:12px; margin-left:4px;"></i>
                            </a>

                        </div>
                    </div>

                    {{-- Trainer Card --}}
                    @if ($training_details->trainers && $training_details->trainers->count())
                        <div class="td-trainer-card">
                            <div class="td-trainer-header">
                                <h4><i class="fas fa-chalkboard-teacher" style="margin-right:6px; font-size:13px;"></i> Trainer(s)</h4>
                            </div>
                            <div class="td-trainer-body">
                                @foreach ($training_details->trainers as $trainer)
                                    <div class="td-trainer-item">
                                        @if ($trainer->trainer_image)
                                            <img class="td-trainer-avatar" src="{{ asset($trainer->trainer_image) }}" alt="{{ $trainer->name }}">
                                        @else
                                            <div class="td-trainer-avatar-placeholder">
                                                {{ strtoupper(substr($trainer->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <a href="{{ route('frontend.trainer.details', $trainer->slug) }}" class="td-trainer-name">
                                                {{ $trainer->name }}
                                            </a>
                                            @if ($trainer->designation)
                                                <span class="td-trainer-desig">{{ $trainer->designation }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Contact Card --}}
                    <div class="service-details__get-started">
                        <h3 class="service-details__get-started-title">Get Started Today</h3>
                        <p class="service-details__get-started-text">
                            Whether you require structured financial support, compliance management, or capability development, we are ready to assist.
                        </p>
                        <ul class="service-details__get-started-points list-unstyled">
                            <li>
                                <div class="icon">
                                    <span class="icon-call"></span>
                                </div>
                                <p>
                                    <a href="tel:{{ siteSetting()->site_phone }}">{{ siteSetting()->site_phone }}</a>
                                    <br>
                                    <a href="tel:{{ siteSetting()->site_phone_alter }}">{{ siteSetting()->site_phone_alter }}</a>
                                </p>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-email"></span>
                                </div>
                                <p>
                                    <a href="mailto:{{ siteSetting()->site_email }}">{{ siteSetting()->site_email }}</a>
                                    <br>
                                    <a href="mailto:{{ siteSetting()->site_email_alter }}">{{ siteSetting()->site_email_alter }}</a>
                                </p>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-pin"></span>
                                </div>
                                <p>{{ siteSetting()->head_address }}</p>
                            </li>
                        </ul>
                        <div class="service-details__get-started-btn-box">
                            <a href="{{ route('frontend.contact.us') }}" class="thm-btn">get in touch <span class="fas fa-arrow-right"></span></a>
                        </div>
                    </div>

                </div>

                {{-- ── RIGHT: MAIN ── --}}
                <div class="col-lg-8 col-xl-8">
                    <div class="td-main-card">

                        {{-- Image --}}
                        @if ($training_details->training_image)
                            <img class="td-main-img" src="{{ asset($training_details->training_image) }}" alt="{{ $training_details->title }}">
                        @endif

                        <div class="td-main-body">

                            {{-- Tags --}}
                            <div class="td-main-meta">
                                @if ($training_details->type)
                                    <span class="td-tag td-tag--type">
                                        <i class="fas fa-wifi" style="font-size:10px;"></i>
                                        {{ ucfirst($training_details->type) }}
                                    </span>
                                @endif
                                @if ($training_details->certification)
                                    <span class="td-tag td-tag--cert">
                                        <i class="fas fa-certificate" style="font-size:10px;"></i>
                                        Certification: {{ $training_details->certification }}
                                    </span>
                                @endif
                                @if ($training_details->course_start)
                                    <span class="td-tag td-tag--start">
                                        <i class="far fa-calendar-alt" style="font-size:10px;"></i>
                                        Starts {{ \Carbon\Carbon::parse($training_details->course_start)->format('d M Y') }}
                                    </span>
                                @endif
                            </div>

                            {{-- Title --}}
                            <h1 class="td-main-title">{{ $training_details->title }}</h1>

                            {{-- Long Description --}}
                            <div class="td-main-content">
                                {!! $training_details->long_description !!}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
