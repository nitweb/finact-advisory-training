@extends('frontend.dashboard')
@section('frontend_title', 'Enrollment Successful')

@section('frontend_content')

    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Enrollment Submitted</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li><a href="{{ route('frontend.training.development') }}">Training</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Success</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="success-wrap">
        <div class="container">
            <div class="success-box">

                {{-- Top --}}
                <div class="success-box__top no-print">
                    <div class="success-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <h2>Enrollment Submitted!</h2>
                    <p>Your enrollment request has been received. We will verify your payment shortly.</p>
                    <div class="success-invoice-badge">
                        <i class="fas fa-receipt" style="font-size:12px;"></i>
                        {{ $enrollment->invoice }}
                    </div>
                </div>

                {{-- Printable Invoice Area --}}
                <div class="success-box__body" id="invoice-print-area">

                    {{-- Student Details --}}
                    <p class="success-section-title">Student Details</p>
                    <div class="success-details">
                        <div class="success-row">
                            <span class="lbl">Name</span>
                            <span class="val">{{ $enrollment->name }}</span>
                        </div>
                        <div class="success-row">
                            <span class="lbl">Phone</span>
                            <span class="val">{{ $enrollment->phone }}</span>
                        </div>
                        @if ($enrollment->email)
                            <div class="success-row">
                                <span class="lbl">Email</span>
                                <span class="val">{{ $enrollment->email }}</span>
                            </div>
                        @endif
                    </div>

                    {{-- Course Details --}}
                    <p class="success-section-title">Course Details</p>
                    <div class="success-details">
                        <div class="success-row">
                            <span class="lbl">Invoice</span>
                            <span class="val">{{ $enrollment->invoice }}</span>
                        </div>
                        <div class="success-row">
                            <span class="lbl">Course</span>
                            <span class="val">{{ $enrollment->training->title }}</span>
                        </div>
                        @if ($enrollment->training->type)
                            <div class="success-row">
                                <span class="lbl">Type</span>
                                <span class="val">{{ ucfirst($enrollment->training->type) }}</span>
                            </div>
                        @endif
                        @if ($enrollment->training->course_start)
                            <div class="success-row">
                                <span class="lbl">Starts</span>
                                <span class="val">
                                    {{ \Carbon\Carbon::parse($enrollment->training->course_start)->format('d M Y') }}
                                </span>
                            </div>
                        @endif
                        <div class="success-row">
                            <span class="lbl">bKash Number</span>
                            <span class="val">{{ $enrollment->bkash_number }}</span>
                        </div>
                        <div class="success-row">
                            <span class="lbl">bKash TRX ID</span>
                            <span class="val">{{ $enrollment->bkash_trx_id }}</span>
                        </div>
                        <div class="success-row">
                            <span class="lbl">Amount Paid</span>
                            <span class="val" style="font-size:16px; font-weight:700; color:#163355;">
                                ৳ {{ number_format($enrollment->amount) }}
                            </span>
                        </div>
                        <div class="success-row">
                            <span class="lbl">Status</span>
                            <span class="val">
                                <span class="success-status">
                                    <span class="dot"></span>
                                    Pending Verification
                                </span>
                            </span>
                        </div>
                        <div class="success-row">
                            <span class="lbl">Submitted At</span>
                            <span class="val">{{ $enrollment->created_at->format('d M Y, h:i A') }}</span>
                        </div>
                    </div>

                    {{-- Notice --}}
                    <div class="success-notice no-print">
                        <i class="fas fa-info-circle"></i>
                        <div>
                            Your payment is being verified. You will be contacted on
                            <strong>{{ $enrollment->phone }}</strong> within 24 hours.
                            Please keep your Transaction ID <strong>{{ $enrollment->bkash_trx_id }}</strong> safe.
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="success-actions no-print">
                        {{-- Download/Print Invoice --}}
                        <a href="{{ route('frontend.training.enroll.invoice', $enrollment->invoice) }}" class="success-btn-download">
                            <i class="fas fa-download"></i>
                            Download Invoice
                        </a>

                        <a href="{{ route('frontend.training.development') }}" class="success-btn-primary">
                            <i class="fas fa-list" style="font-size:12px;"></i>
                            More Courses
                        </a>
                        <a href="{{ route('frontend.index') }}" class="success-btn-outline">
                            <i class="fas fa-home" style="font-size:12px;"></i>
                            Go to Home
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
