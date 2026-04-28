@extends('frontend.dashboard')
@section('frontend_title', 'Training & Development')

@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Training & Development</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Training & Development</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <section class="blog-page">
        <div class="container">

            <div class="training-grid">

                @foreach ($training_list as $item)
                    <div class="t-card">

                        {{-- Image --}}
                        <div class="t-img-wrap">
                            <img src="{{ asset($item->training_image) }}" alt="{{ $item->title }}">
                            @if ($item->type)
                                <span class="t-type-badge">{{ ucfirst($item->type) }}</span>
                            @endif
                            @if ($item->course_start)
                                <span class="t-deadline">
                                    <i class="far fa-calendar-alt" style="font-size:10px;"></i>
                                    Starts: {{ \Carbon\Carbon::parse($item->course_start)->format('d M Y') }}
                                </span>
                            @endif
                        </div>

                        <div class="t-body">

                            {{-- Title --}}
                            <h3 class="t-title">
                                <a href="{{ route('frontend.training.development.details', $item->slug) }}">
                                    {{ Str::limit($item->title, 55) }}
                                </a>
                            </h3>

                            {{-- Description --}}
                            <p class="t-desc">{{ Str::limit($item->short_description, 100) }}</p>

                            {{-- Pills: duration + cert --}}
                            <div class="t-pills">
                                @if ($item->no_of_classes)
                                    <div class="t-pill">
                                        <i class="far fa-bookmark"></i>
                                        {{ $item->no_of_classes }} Classes
                                    </div>
                                @endif
                                @if ($item->duration)
                                    <div class="t-pill">
                                        <i class="far fa-clock"></i>
                                        {{ $item->duration }} Hours
                                    </div>
                                @endif
                                @if ($item->certification)
                                    <div class="t-pill">
                                        <i class="fas fa-certificate"></i>
                                        Certification: {{ Str::limit($item->certification, 22) }}
                                    </div>
                                @endif
                            </div>

                            {{-- Deadline strip --}}
                            @if ($item->registration_deadline)
                                <div class="t-deadline-strip">
                                    <i class="far fa-clock"></i>
                                    Reg. Deadline: {{ \Carbon\Carbon::parse($item->registration_deadline)->format('d M Y') }}
                                </div>
                            @endif

                            {{-- Fee row --}}
                            <div class="t-fee-row">
                                <div class="t-fee-block">
                                    <span class="t-fee-lbl">Regular Fee</span>
                                    @if ($item->regular_fee)
                                        <span class="t-fee-reg">৳ {{ number_format($item->regular_fee) }}</span>
                                    @else
                                        <span class="t-fee-main">—</span>
                                    @endif
                                </div>
                                <div class="t-fee-divider"></div>
                                <div class="t-fee-block">
                                    <span class="t-fee-lbl">Registration Fee</span>
                                    <span class="t-fee-main">
                                        {{ $item->registration_fee ? '৳ ' . number_format($item->registration_fee) : '—' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div class="t-actions">
                                <a href="{{ route('frontend.training.development.details', $item->slug) }}" class="t-btn-outline">
                                    View Details
                                </a>
                                <a href="{{ route('frontend.training.enroll', $item->slug) }}" class="t-btn-fill">
                                    Enroll Now
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

            {{-- Pagination --}}
            @if ($training_list->lastPage() > 1)
                <div class="blog-list__pagination" style="margin-top: 20px;">
                    <ul class="pg-pagination list-unstyled">
                        @if ($training_list->onFirstPage())
                            <li class="prev disabled" style="display:none;"><span><i class="fas fa-angle-left"></i></span></li>
                        @else
                            <li class="prev"><a href="{{ $training_list->previousPageUrl() }}" aria-label="Previous"><i class="fas fa-angle-left"></i></a></li>
                        @endif

                        @for ($i = 1; $i <= $training_list->lastPage(); $i++)
                            <li class="count {{ $training_list->currentPage() == $i ? 'active' : '' }}">
                                <a href="{{ $training_list->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if ($training_list->hasMorePages())
                            <li class="next"><a href="{{ $training_list->nextPageUrl() }}" aria-label="Next"><i class="fas fa-angle-right"></i></a></li>
                        @else
                            <li class="next disabled" style="display:none;"><span><i class="fas fa-angle-right"></i></span></li>
                        @endif
                    </ul>
                </div>
            @endif

        </div>
    </section>

@endsection
