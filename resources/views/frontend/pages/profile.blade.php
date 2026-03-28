@extends('frontend.master')

@section('frontend_title', 'Successful Portfolios')

@section('frontend_content')

    <style>
        ._df_thumb {
            margin: 0 auto;
            display: block;
            width: 300px;
            height: 360px;
        }
    </style>

    <div class="wrap-slider" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://mazamanca.com/frontend/img/cover_about_us.jpg') no-repeat center; background-size: cover; height: 100px; display: flex; align-items: center; justify-content: center;">
        <div class="container text-center">
            <h1 style="color: #fff; font-size: 2.5rem; font-weight: bold; margin: 0;">Successful Portfolios</h1>
            <ul class="breadcrumbs" style="list-style: none; padding: 0; display: inline-flex; gap: 10px; color: #fff;">
                <li><a href="{{ route('frontend.index') }}" style="color: #fff; text-decoration: none;">Home</a></li>
                <li>/</li>
                <li>Successful Portfolios</li>
            </ul>
        </div>
    </div>

    <section class="flat-row v16 section-project bg-theme">

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <div class="_df_thumb" id="df_manual_thumb" height="100%" source="{{ asset($successful_portfolios->pdf_file) }}" thumb="{{ asset($successful_portfolios->pdf_image) }}"> Rahman Anis & Co - CA Company Profile</div>

                </div>

            </div>

        </div>

    </section>

@endsection
