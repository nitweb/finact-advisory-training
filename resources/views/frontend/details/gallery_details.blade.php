@extends('frontend.master')

@section('frontend_title', $gallery->title)

@section('frontend_content')

    <div class="wrap-slider" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://mazamanca.com/frontend/img/cover_about_us.jpg') no-repeat center; background-size: cover; height: 100px; display: flex; align-items: center; justify-content: center;">
        <div class="container text-center">
            <h1 style="color: #fff; font-size: 2.5rem; font-weight: bold; margin: 0;">{{ $gallery->title }}</h1>
            <ul class="breadcrumbs" style="list-style: none; padding: 0; display: inline-flex; gap: 10px; color: #fff;">
                <li><a href="{{ route('frontend.index') }}" style="color: #fff; text-decoration: none;">Home</a></li>
                <li>/</li>
                <li>Gallery Details</li>
            </ul>
        </div>
    </div>

    <section class="flat-row v5 choose-us">

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="choseus">

                        <img src="{{ asset($gallery->image) }}" alt="image" width="100%">

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="wrap-accordion">

                        <div class="title-section style2">

                            <h1 class="title">{{ $gallery->title }}</h1>

                            <div style="text-align: justify; margin-top: 20px;">{!! $gallery->description !!}</div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


@endsection
