@extends('frontend.master')

@section('frontend_title', 'Career Opportunities')

@section('frontend_content')

    <div class="wrap-slider" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://mazamanca.com/frontend/img/cover_about_us.jpg') no-repeat center; background-size: cover; height: 100px; display: flex; align-items: center; justify-content: center;">
        <div class="container text-center">
            <h1 style="color: #fff; font-size: 2.5rem; font-weight: bold; margin: 0;">Career Opportunity</h1>
            <ul class="breadcrumbs" style="list-style: none; padding: 0; display: inline-flex; gap: 10px; color: #fff;">
                <li><a href="{{ route('frontend.index') }}" style="color: #fff; text-decoration: none;">Home</a></li>
                <li>/</li>
                <li>Career Opportunity</li>
            </ul>
        </div>
    </div>


    <section class="flat-row v16 choose-us2" style="padding-top:0; margin-top: 20;">
        <div class="container">
            <div class="row">
                @foreach ($career as $item)
                    <div class="col-md-4 col-sm-6 text-center" style="margin-top: 50px;" data-aos="fade-up-right" data-aos-delay="50" data-aos-duration="1000">
                        <article class="post style2 column col-style2 clearfix">
                            <a href="{{ route('frontend.career.details', $item->slug) }}">
                                <div class="featured-post">
                                    <img src="{{ asset($item->career_image) }}" alt="image" style="width: 100%; height: 250px;">
                                </div>
                                <div class="content-post">
                                    <h2 class="title-post">{{ $item->title }}</h2>
                                    <p>Open Positions</p>
                                </div>
                            </a>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
