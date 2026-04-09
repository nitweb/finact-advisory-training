@extends('frontend.dashboard')
@section('frontend_title', 'Our Services')
@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Services</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Services</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Services Page Start -->
    <section class="services-page">

        <div class="container">

            <div class="technology__content" data-aos="fade-up" style="margin-bottom: 50px;">
                <p class="strategic-direction__text">
                    In today’s complex business environment, organizations require more than traditional accounting support. They need structured finance functions that strengthen control, ensure compliance, and support informed decision-making.
                </p>
                <p class="strategic-direction__text">
                    <strong>FINACT Advisory & Training</strong> provides integrated bookkeeping, accounting, finance, compliance, and advisory services designed to improve financial processes, strengthen operational discipline, and support effective business management. Our approach is practical and implementation-focused—ensuring that financial systems, controls, compliances and reporting processes work reliably in day-to-day operations.
                </p>
            </div>



            <div class="row">
                @foreach ($services as $item)
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInLeft d-flex" data-wow-delay="100ms">
                        <div class="services-two__single w-100 d-flex flex-column">
                            <div class="services-two__img-box">
                                <div class="services-two__img" style="height: 250px; overflow: hidden;">
                                    <img src="{{ asset($item->serviceDetail->service_image) }}" alt="{{ $item->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            </div>
                            <div class="services-two__content d-flex flex-column flex-grow-1">
                                <h3 class="services-two__title">
                                    <a href="{{ route('frontend.service.details', $item->slug) }}">{{ $item->title }}</a>
                                </h3>
                                <p class="services-two__text flex-grow-1">{{ $item->serviceDetail->short_description }}</p>
                                <div class="services-two__plus mt-auto">
                                    <a href="{{ route('frontend.service.details', $item->slug) }}"><span class="fas fa-plus"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--Services Page End -->

@endsection
