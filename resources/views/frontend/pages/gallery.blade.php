@extends('frontend.master')

@section('frontend_title', 'Gallery')

@section('frontend_content')

    <div class="wrap-slider" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://mazamanca.com/frontend/img/cover_about_us.jpg') no-repeat center; background-size: cover; height: 100px; display: flex; align-items: center; justify-content: center;">
        <div class="container text-center">
            <h1 style="color: #fff; font-size: 2.5rem; font-weight: bold; margin: 0;">Gallery</h1>
            <ul class="breadcrumbs" style="list-style: none; padding: 0; display: inline-flex; gap: 10px; color: #fff;">
                <li><a href="{{ route('frontend.index') }}" style="color: #fff; text-decoration: none;">Home</a></li>
                <li>/</li>
                <li>Gallery</li>
            </ul>
        </div>
    </div>

    <section class="flat-row v16 section-project">

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <div class="iso-portfolio">

                        @foreach ($gallery as $item)
                            <div class="portfolio-item item marketing finance planning analytics" data-aos="zoom-in" data-aos-delay="50" data-aos-duration="1000">
                                <div class="portfolio-wrap">
                                    <div class="portfolio-thumbnail">
                                        <a href="{{ route('frontend.gallery.details', $item->id) }}"><img src="{{ asset($item->image) }}" alt="image" style="width: 100%;"></a>
                                    </div>
                                    <div class="portfolio-info">
                                        <div class="portfolio-info-wrap">
                                            <h6 class="portfolio-title">
                                                <a>{{ $item->title }}</a>
                                            </h6>
                                        </div>
                                        <div class="portfolio-info-icon">
                                            <ul class="portfolio-link">
                                                <li class="icon"><a href="{{ route('frontend.gallery.details', $item->id) }}"><span><i class="fa-solid fa-link"></i></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
