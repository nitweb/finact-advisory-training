@extends('frontend.dashboard')
@section('frontend_title', $service->title)

@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg);"></div>
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
                            <p class="service-details__get-started-text">Pianissimos of dulcimers qui therefore
                                always
                                holds in these matters to this principle</p>
                            <ul class="service-details__get-started-points list-unstyled">
                                <li>
                                    <div class="icon">
                                        <span class="icon-call"></span>
                                    </div>
                                    <p><a href="tel:585858575084">+58 585 857 5084</a></p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-email"></span>
                                    </div>
                                    <p><a href="mailto:example@gmail.com">example@gmail.com</a></p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <span class="icon-pin"></span>
                                    </div>
                                    <p>4517 Washington Ave. Manchester,<br> Kentucky 39495</p>
                                </li>
                            </ul>
                            <div class="service-details__get-started-btn-box">
                                <a href="contact.html" class="thm-btn">get in
                                    touch <span class="fas fa-arrow-right"></span></a>
                            </div>
                        </div>

                        <div class="service-details__sidebar-download-box">
                            <h3 class="service-details__services-title">Download</h3>
                            <div class="service-details__sidebar-single-download">

                                <ul class="clearfix list-unstyled">
                                    <li>
                                        <div class="content-box">
                                            <div class="icon">
                                                <span class="far fa-file-pdf"></span>
                                            </div>
                                            <div class="text-box">
                                                <h5><a href="#">Pdf Download</a></h5>
                                                <p><a href="#">Download</a></p>
                                            </div>
                                        </div>

                                        <div class="btn-box">
                                            <a href="#"><span class="far fa-cloud-download"></span></a>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="content-box">
                                            <div class="icon">
                                                <span class="far fa-file-pdf"></span>
                                            </div>
                                            <div class="text-box">
                                                <h5><a href="#">Pdf Download</a></h5>
                                                <p><a href="#">Download</a></p>
                                            </div>
                                        </div>

                                        <div class="btn-box">
                                            <a href="#"><span class="far fa-cloud-download"></span></a>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="content-box">
                                            <div class="icon">
                                                <span class="far fa-file-pdf"></span>
                                            </div>
                                            <div class="text-box">
                                                <h5><a href="#">Pdf Download</a></h5>
                                                <p><a href="#">Download</a></p>
                                            </div>
                                        </div>

                                        <div class="btn-box">
                                            <a href="#"><span class="far fa-cloud-download"></span></a>
                                        </div>
                                    </li>
                                </ul>
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

                        <div class="service-details__text-1" style="text-align: justify;">{!! $service->serviceDetail->long_description !!}</div>

                    </div>
                </div>

            </div>

        </div>

    </section>
    <!--Service Details End-->

@endsection
