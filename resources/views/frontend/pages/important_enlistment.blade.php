@extends('frontend.master')

@section('frontend_title', 'Important Enlistment')

@section('frontend_content')

    <div class="wrap-slider" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://mazamanca.com/frontend/img/cover_about_us.jpg') no-repeat center; background-size: cover; height: 100px; display: flex; align-items: center; justify-content: center;">
        <div class="container text-center">
            <h1 style="color: #fff; font-size: 2.5rem; font-weight: bold; margin: 0;">Important Enlistment</h1>
            <ul class="breadcrumbs" style="list-style: none; padding: 0; display: inline-flex; gap: 10px; color: #fff;">
                <li><a href="{{ route('frontend.index') }}" style="color: #fff; text-decoration: none;">Home</a></li>
                <li>/</li>
                <li>Important Enlistment</li>
            </ul>
        </div>
    </div>

    <section class="flat-row v16 choose-us2">

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <div class="title-section style1">

                        <h1 class="title">Important Enlistment</h1>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12 ove-hide">

                    <div class="divider h31">

                    </div>

                    <div class="wrap-iconbox">

                        <div class="iconbox compact left style2 maxwidth">

                            <div class="box-content" style="text-align: justify;">

                                {!! $enlistment->description !!}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
