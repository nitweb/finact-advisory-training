@extends('frontend.dashboard')
@section('frontend_title', 'Enroll - ' . $training->title)

@section('frontend_content')

    <!--Page Header-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Course Enrollment</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li><a href="{{ route('frontend.training.development') }}">Training</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Enroll</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="enroll-wrap">
        <div class="container">

            @if (session('error'))
                <div class="enroll-alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ session('error') }}
                </div>
            @endif

            <div class="enroll-grid">

                {{-- ── LEFT: Student Form ── --}}
                <div class="enroll-card">
                    <div class="enroll-card__head">
                        <h3>Student Information</h3>
                        <div class="enroll-card__head-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>
                    <div class="enroll-card__body">

                        <form action="{{ route('frontend.training.enroll.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="training_id" value="{{ $training->id }}">

                            <div class="enroll-row">
                                <div class="enroll-field">
                                    <label>Full Name *</label>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Your full name" required>
                                    @error('name')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="enroll-field">
                                    <label>WhatsApp Number *</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="01XXXXXXXXX" required>
                                    @error('phone')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="enroll-row">
                                <div class="enroll-field">
                                    <label>Email (optional)</label>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com">
                                    @error('email')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="enroll-field">
                                    <label>Address (optional)</label>
                                    <input type="text" name="address" value="{{ old('address') }}" placeholder="City, Area">
                                </div>
                            </div>

                            <div class="enroll-field">
                                <label>Note (optional)</label>
                                <textarea name="note" placeholder="Any special message or question...">{{ old('note') }}</textarea>
                            </div>

                            <div class="enroll-divider"></div>

                            {{-- bKash Payment Section --}}
                            <div class="bkash-section">
                                <div class="bkash-section__title">
                                    <i class="fas fa-mobile-screen-button"></i>
                                    bKash Payment
                                </div>

                                <div class="bkash-instruction">
                                    <strong>How to pay:</strong>
                                    Send <strong>৳ {{ number_format($training->registration_fee ?? 0) }}</strong>
                                    to the bKash number below using <strong>Send Money</strong>,
                                    then enter your bKash number and Transaction ID below.
                                </div>

                                <div class="bkash-number-display">
                                    <i class="fas fa-phone-alt"></i>
                                    {{ siteSetting()->bkash_number ?? '01325221133' }}
                                </div>

                                <div class="enroll-row" style="margin-bottom:0;">
                                    <div class="enroll-field" style="margin-bottom:0;">
                                        <label>Your bKash Number *</label>
                                        <input type="text" name="bkash_number" value="{{ old('bkash_number') }}" placeholder="01XXXXXXXXX" required>
                                        @error('bkash_number')
                                            <small>{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="enroll-field" style="margin-bottom:0;">
                                        <label>Transaction ID *</label>
                                        <input type="text" name="bkash_trx_id" value="{{ old('bkash_trx_id') }}" placeholder="e.g. 8A7B6C5D4E" required>
                                        @error('bkash_trx_id')
                                            <small>{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="enroll-submit-btn">
                                <i class="fas fa-check-circle"></i>
                                Complete Enrollment
                            </button>

                        </form>
                    </div>
                </div>

                {{-- ── RIGHT: Order Summary ── --}}
                <div class="enroll-card">
                    <div class="enroll-card__head">
                        <h3>Order Summary</h3>
                        <div class="enroll-card__head-icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                    </div>
                    <div class="enroll-card__body">

                        {{-- Training image --}}
                        @if ($training->training_image)
                            <img src="{{ asset($training->training_image) }}" alt="{{ $training->title }}" style="width:100%; height:160px; object-fit:cover; border-radius:8px; margin-bottom:14px;">
                        @endif

                        {{-- Info rows --}}
                        <div>
                            <div class="summary-item">
                                <span class="summary-item__lbl">Course</span>
                                <span class="summary-item__val">{{ $training->title }}</span>
                            </div>
                            @if ($training->type)
                                <div class="summary-item">
                                    <span class="summary-item__lbl">Type</span>
                                    <span class="summary-item__val">{{ ucfirst($training->type) }}</span>
                                </div>
                            @endif
                            @if ($training->duration)
                                <div class="summary-item">
                                    <span class="summary-item__lbl">Duration</span>
                                    <span class="summary-item__val">{{ $training->duration }} Hours</span>
                                </div>
                            @endif
                            @if ($training->no_of_classes)
                                <div class="summary-item">
                                    <span class="summary-item__lbl">Classes</span>
                                    <span class="summary-item__val">{{ $training->no_of_classes }}</span>
                                </div>
                            @endif
                            @if ($training->certification)
                                <div class="summary-item">
                                    <span class="summary-item__lbl">Certificate</span>
                                    <span class="summary-item__val">{{ $training->certification }}</span>
                                </div>
                            @endif
                            @if ($training->course_start)
                                <div class="summary-item">
                                    <span class="summary-item__lbl">Starts</span>
                                    <span class="summary-item__val">
                                        {{ \Carbon\Carbon::parse($training->course_start)->format('d M Y') }}
                                    </span>
                                </div>
                            @endif
                            @if ($training->registration_deadline)
                                <div class="summary-item">
                                    <span class="summary-item__lbl">Deadline</span>
                                    <span class="summary-item__val">
                                        {{ \Carbon\Carbon::parse($training->registration_deadline)->format('d M Y') }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Fee box --}}
                        <div class="summary-fee-box">
                            @if ($training->regular_fee)
                                <div class="summary-fee-row">
                                    <span class="lbl">Regular Fee</span>
                                    <span class="val-strike">৳ {{ number_format($training->regular_fee) }}</span>
                                </div>
                            @endif
                            <div class="summary-fee-row">
                                <span class="lbl">Registration Fee</span>
                                <span class="val-main">
                                    ৳ {{ number_format($training->registration_fee ?? 0) }}
                                </span>
                            </div>
                        </div>

                        <a href="{{ route('frontend.training.development.details', $training->slug) }}" class="summary-back-btn">
                            <i class="fas fa-arrow-left" style="font-size:12px;"></i>
                            Back to Course Details
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
