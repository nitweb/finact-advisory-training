@extends('frontend.master')

@section('frontend_title', 'About Us')

@section('frontend_content')

    <div class="wrap-slider" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://mazamanca.com/frontend/img/cover_about_us.jpg') no-repeat center; background-size: cover; height: 100px; display: flex; align-items: center; justify-content: center;">
        <div class="container text-center">
            <h1 style="color: #fff; font-size: 2.5rem; font-weight: bold; margin: 0;">About Us</h1>
            <ul class="breadcrumbs" style="list-style: none; padding: 0; display: inline-flex; gap: 10px; color: #fff;">
                <li><a href="{{ route('frontend.index') }}" style="color: #fff; text-decoration: none;">Home</a></li>
                <li>/</li>
                <li>About Us</li>
            </ul>
        </div>
    </div>

    {{-- About Our Firm --}}
    <section class="flat-row v16 choose-us2" style="padding-bottom: 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12" data-aos="fade-up">
                    <div class="title-section style1">
                        <h1 class="title">About Our Firm</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 ove-hide" data-aos="fade-right" data-aos-delay="50" data-aos-duration="1000">
                    <div class="wrap-iconbox">
                        <div class="iconbox compact left style2 maxwidth">
                            <div class="box-content" style="text-align: justify;">
                                <p> {!! $about_us->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ove-hide" data-aos="fade-left" data-aos-delay="50" data-aos-duration="1000">
                    <div class="choseus">
                        <img src="{{ asset($about_us->about_us_image) }}" alt="image" style="height: 550px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .col-md-3.col-sm-6 {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* Ensures the content aligns properly */
        }

        .post.style2.column.col-style2 {
            height: 100%;
            /* Makes the cards consistent in height */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Optional styling */
            /* padding: 15px; */
        }

        .featured-post img {
            width: 100%;
            /* Ensures images are consistent */
            /* height: 250px; */
            /* Fix the height of images */
            object-fit: cover;
            /* Keeps aspect ratio intact */
        }

        .content-post {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .title-post {
            font-size: 16px;
            margin-bottom: 10px;
        }

        p {
            flex-grow: 1;
            /* Takes up remaining space between title and "Read More" */
            font-size: 14px;
            margin: 15px 0;
        }

        .readmore {
            align-self: flex-start;
            margin-top: auto;
            /* Pushes the "Read More" link to the bottom */
            font-size: 13px;
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
        }

        .readmore:hover {
            text-decoration: none;
        }

        .post.style2.column .content-post .readmore::before {
            top: 20px;
        }
    </style>

    {{-- Our Mission/Our Vision/Shared Beliefs --}}
    <section class="flat-row pdtop">
        <div class="container">
            <div class="row">

                <div class="col-md-4 col-sm-6" style="margin-top: 50px;" data-aos="fade-up-right" data-aos-delay="50" data-aos-duration="1000">
                    <article class="post style2 column col-style2 clearfix">
                        <div class="featured-post">
                            <img src="{{ asset($our_mission->image) }}" alt="image">
                        </div>
                        <div class="content-post">
                            <h2 class="title-post"><a>Our Mission</a></h2>
                            <div style="text-align: justify;">{!! $our_mission->description !!}</div>
                        </div>
                    </article>
                </div>

                <div class="col-md-4 col-sm-6" style="margin-top: 50px;" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
                    <article class="post style2 column col-style2 clearfix">
                        <div class="featured-post">
                            <img src="{{ asset($our_vision->image) }}" alt="image">
                        </div>
                        <div class="content-post">
                            <h2 class="title-post"><a>Our Vision</a></h2>
                            <div style="text-align: justify;">{!! $our_vision->description !!}</div>
                        </div>
                    </article>
                </div>

                <div class="col-md-4 col-sm-6" style="margin-top: 50px;" data-aos="fade-up-left" data-aos-delay="50" data-aos-duration="1000">
                    <article class="post style2 column col-style2 clearfix">
                        <div class="featured-post">
                            <img src="{{ asset($shared_beliefs->image) }}" alt="image">
                        </div>
                        <div class="content-post">
                            <h2 class="title-post"><a>Shared Beliefs</a></h2>
                            <div style="text-align: justify;">{!! $shared_beliefs->description !!}</div>
                        </div>
                    </article>
                </div>

            </div>
        </div>
    </section>

    {{-- Message From The Managing Partner --}}
    <section class="flat-row v5 choose-us2" style="padding-top: 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12" data-aos="fade-up">
                    <div class="title-section style1">
                        <h1 class="title">Message From The Managing Partner</h1>
                    </div>
                </div>
            </div>
            <div class="row custom_partner_message">
                <div class="col-md-12 ove-hide" data-aos="fade-right" data-aos-delay="50" data-aos-duration="1000">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="choseus">
                                <img src="{{ asset($about_message->about_us_image) }}" alt="image" width="100%">
                            </div>
                        </div>
                        <div class="col-md-9">{!! $about_message->short_description !!}</div>
                    </div>
                </div>
                <div class="col-md-12 ove-hide" data-aos="fade-left" data-aos-delay="50" data-aos-duration="1000">
                    <div class="divider h31"></div>
                    <div class="wrap-iconbox">
                        <div class="iconbox compact left style2 maxwidth">
                            <div class="box-content" style="text-align: justify;">
                                <p> {!! $about_message->description !!}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Organizational Strength/Operational Strength --}}
    <section class="flat-row v5 choose-us2" style="padding-top: 0;">
        <div class="container">
            <div class="row">

                <div class="col-md-12" data-aos="fade-up">
                    <div class="title-section style1">
                        <h1 class="title">Our Strengths</h1>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6 col-sm-6" data-aos="fade-up-right" data-aos-delay="50" data-aos-duration="1000">
                    <article class="post style2 column col-style2 clearfix">
                        <div class="featured-post">
                            <img src="{{ asset($organizational_strength->image) }}" alt="image">
                        </div>
                        <div class="content-post">
                            <h2 class="title-post"><a>Organizational Strength</a></h2>
                            <div style="text-align: justify;">{!! $organizational_strength->description !!}</div>
                        </div>
                    </article>
                </div>

                <div class="col-md-6 col-sm-6" data-aos="fade-up-left" data-aos-delay="50" data-aos-duration="1000">
                    <article class="post style2 column col-style2 clearfix">
                        <div class="featured-post">
                            <img src="{{ asset($operational_strength->image) }}" alt="image">
                        </div>
                        <div class="content-post">
                            <h2 class="title-post"><a>Operational Strength</a></h2>
                            <div style="text-align: justify;">{!! $operational_strength->description !!}</div>
                        </div>
                    </article>
                </div>

            </div>
        </div>
    </section>

    {{-- Commitment --}}
    <section class="flat-row v5 choose-us2" style="padding-top: 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12" data-aos="fade-up">
                    <div class="title-section style1">
                        <h1 class="title">Commitment</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 ove-hide" data-aos="fade-right" data-aos-delay="50" data-aos-duration="1000">
                    <div class="divider h31"></div>
                    <div class="wrap-iconbox">
                        <div class="iconbox compact left style2 maxwidth">
                            <div class="box-content" style="text-align: justify;">
                                <div style="font-size: 20px;line-height: 40px;">{!! $commitment->description !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ove-hide" data-aos="fade-left" data-aos-delay="50" data-aos-duration="1000">
                    <div class="choseus">
                        <img src="{{ asset($commitment->image) }}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
