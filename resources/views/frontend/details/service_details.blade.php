@extends('frontend.dashboard')
@section('frontend_title', $service->title)

@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
         <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>{{ $service->title }}</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li><a href="{{ route('frontend.all.services.list') }}">Services</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>{{ $service->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Service Details Start-->
    <section class="service-details">

        <div class="container">

            <div class="row">

                <div class="col-xl-4 col-lg-5">

                    <div class="service-details__sidebar">

                        <div class="service-details__services-box">
                            <h3 class="service-details__services-title">Our Services</h3>
                            <ul class="service-details__services-list list-unstyled">
                                @foreach ($service_list as $item)
                                    <li class="{{ $item->slug == $service->slug ? 'active' : '' }}">
                                        <a href="{{ route('frontend.service.details', $item->slug) }}">{{ $item->title }}<span class="icon-arrow-right"></span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

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

                </div>

                <div class="col-xl-8 col-lg-7">

                    <div class="service-details__left">

                        <div class="service-details__img">
                            <img src="{{ asset($service->serviceDetail->service_image) }}" alt="{{ $service->title }}">
                        </div>

                        <h3 class="service-details__title-1">{{ $service->title }}</h3>


                        <div class="service-details__text-1">{!! $service->serviceDetail->long_description !!}</div>

                        @if ($service->slug == 'training-capability-development')
                            <br><br>

                            <div class="service-details__text-1" style="text-align: justify;">
                                For upcoming programs and schedules, please visit our Training & Development page
                                <div class="service-details__get-started-btn-box" style="margin-top: 10px;">
                                    <a href="{{ route('frontend.training.development') }}" class="thm-btn" style="width: inherit; font-size: 15px; padding: 5px 15px;">
                                        Training Programs Details <span class="fas fa-arrow-right"></span>
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!--Service Details End-->

@endsection
