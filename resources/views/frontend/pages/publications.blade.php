@extends('frontend.master')

@section('frontend_title', 'Publications')

@section('frontend_content')

    <div class="wrap-slider" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://mazamanca.com/frontend/img/cover_about_us.jpg') no-repeat center; background-size: cover; height: 100px; display: flex; align-items: center; justify-content: center;">
        <div class="container text-center">
            <h1 style="color: #fff; font-size: 2.5rem; font-weight: bold; margin: 0;">Publications</h1>
            <ul class="breadcrumbs" style="list-style: none; padding: 0; display: inline-flex; gap: 10px; color: #fff;">
                <li><a href="{{ route('frontend.index') }}" style="color: #fff; text-decoration: none;">Home</a></li>
                <li>/</li>
                <li>Publications</li>
            </ul>
        </div>
    </div>

    <section class="flat-row v16 choose-us2">

        <div class="container">

            <div class="row">
                <div class="col-md-2"></div>

                <div class="col-md-8 ove-hide" data-aos="fade-right" data-aos-delay="50" data-aos-duration="1000">

                    <div class="wrap-iconbox">

                        <div class="iconbox compact left style2 maxwidth">

                            <div class="box-content" style="text-align: justify;">

                                <h5>You will get all important publications made by Rahman Anis & Co. hereunder:</h5>

                                <ul class="custom_publications">
                                    @if ($publications_data->isEmpty())
                                        <li>No notices or circulars available at the moment.</li>
                                    @else
                                        @foreach ($publications_data as $item)
                                            <li><a href="{{ asset($item->files) }}" target="_blank"><i class="fa-solid fa-circle-chevron-right"></i> {{ $item->title }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-2"></div>
            </div>

        </div>

    </section>

@endsection
