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

    <!--Services Page Start -->
    <section class="service-details">

        <div class="container">

            <div class="row">

                <div class="col-xl-12 col-lg-7">

                    <div class="service-details__left">

                        <div class="service-details__text-1" style="text-align: justify;">{!! $training_info->long_description !!}</div>

                    </div>
                </div>

            </div>

        </div>

    </section>
    <!--Services Page End -->

@endsection
