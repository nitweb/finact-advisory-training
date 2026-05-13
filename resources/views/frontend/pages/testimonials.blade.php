@extends('frontend.dashboard')
@section('frontend_title', 'Testimonials')
@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Testimonials</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Testimonials</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    {{-- Testimonials --}}
    <section class="testimonial-page">

        <div class="container">

            <div class="row">

                @foreach ($testimonials as $item)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="testimonial-one__single">
                            <div class="testimonial-one__single-inner">
                                <div class="testimonial-one__single-shape-1"></div>
                                <div class="testimonial-one__star">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $item->rating)
                                            <span class="icon-star-1"></span>
                                        @else
                                            <span class="icon-star"></span>
                                        @endif
                                    @endfor
                                </div>
                                <p class="testimonial-one__text">{{ $item->review_text }}</p>
                            </div>
                            <div class="testimonial-one__client-info">
                                <div class="testimonial-one__client-img">
                                    <img src="{{ asset($item->client_image) }}" alt="{{ $item->client_name }}" style="width: 100%;">
                                </div>
                                <div class="testimonial-one__client-content">
                                    <h4 class="testimonial-one__client-name">
                                        <a href="javascript:void(0);">
                                            {{ $item->client_name }}
                                        </a>
                                    </h4>
                                    <p class="testimonial-one__sub-title">{{ $item->client_designation }}</p>
                                </div>
                            </div>
                            <div class="testimonial-one__quote">
                                <span class="fal fa-quote-right"></span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

@endsection
