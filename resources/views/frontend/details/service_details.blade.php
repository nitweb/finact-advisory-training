@extends('frontend.master')

@section('frontend_title', $service->title)

@section('frontend_content')

    <div class="wrap-slider" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://mazamanca.com/frontend/img/cover_about_us.jpg') no-repeat center; background-size: cover; height: 100px; display: flex; align-items: center; justify-content: center;">
        <div class="container text-center">
            <h1 style="color: #fff; font-size: 2.5rem; font-weight: bold; margin: 0;">Services Details</h1>
            <ul class="breadcrumbs" style="list-style: none; padding: 0; display: inline-flex; gap: 10px; color: #fff;">
                <li><a href="{{ route('frontend.index') }}" style="color: #fff; text-decoration: none;">Home</a></li>
                <li>/</li>
                <li>Services Details</li>
            </ul>
        </div>
    </div>





    <section class="flat-row v16 services-detail">

        <div class="container">

            <div class="row">

                <div class="col-md-3 col-sm-4">

                    <div class="sidebar">

                        <div class="widget widget-nav-menu">

                            <ul class="widget-menu">

                                @foreach ($service_list as $item)
                                    <li class="{{ $item->slug == $service->slug ? 'active' : '' }}"><a href="{{ route('frontend.service.details', $item->slug) }}">{{ $item->title }}</a></li>
                                @endforeach

                            </ul>

                        </div>

                        <div class="widget widget-help">

                            <h6>How can we help you?</h6>

                            <p>Contact us at the Consultec WP office near-est to you or submit a business inquiry online.</p>

                            <div class="wrap-style5">
                                <div class="widgets-header-information">
                                    <div class="informaiton-text">
                                        <div class="info-icon">
                                            <div class="btn-click">
                                                <a href="{{ route('frontend.contact.us') }}" class="btn-black">CONTACT US</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-9 col-sm-8">

                    <div class="post-wrap">

                        <article class="post clearfix">

                            <div class="featured-post">

                                <img src="{{ asset($service->serviceDetail->service_image) }}" alt="image">

                            </div><!-- /.feature-post -->

                            <div class="content-post">

                                <h2 class="title-post" style="font-size: 40px;margin-bottom: 25px;"><a>{{ $service->title }}</a></h2>

                                <div class="entry ">

                                    <div class="entry-content-text" style="text-align: justify;">

                                        <p>{!! $service->serviceDetail->long_description !!}</p>

                                    </div>

                                </div>

                            </div><!-- /.content-post -->

                        </article>

                    </div><!-- /.post-wrap -->

                </div>

            </div>

        </div>

    </section>

@endsection
