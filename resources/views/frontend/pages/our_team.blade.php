@extends('frontend.master')

@section('frontend_title', 'Our Team')

@section('frontend_content')

    <div class="wrap-slider" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://mazamanca.com/frontend/img/cover_about_us.jpg') no-repeat center; background-size: cover; height: 100px; display: flex; align-items: center; justify-content: center;">
        <div class="container text-center">
            <h1 style="color: #fff; font-size: 2.5rem; font-weight: bold; margin: 0;">Our Team</h1>
            <ul class="breadcrumbs" style="list-style: none; padding: 0; display: inline-flex; gap: 10px; color: #fff;">
                <li><a href="{{ route('frontend.index') }}" style="color: #fff; text-decoration: none;">Home</a></li>
                <li>/</li>
                <li>Our Team</li>
            </ul>
        </div>
    </div>

    {{-- Meet Our Founder --}}
    <section class="flat-row v7 Teammember">
        <div class="container">
            <div class="row">
                <div class="col-md-12" data-aos="fade-up">
                    <div class="title-section style1">
                        <h1 class="title">Meet Our Founder</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="choseus">
                        <img src="{{ asset($team_founder->team_image) }}" alt="image" width="100%">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrap-accordion">
                        <div class="title-section style2">
                            <h1 class="title">{{ $team_founder->name }}</h1>
                            <div style="text-align: justify; margin-top: 20px;">{!! $team_founder->description !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Meet Our Partners --}}
    <section class="flat-row v7 Teammember bg-theme">
        <div class="container">
            <div class="row">
                <div class="col-md-12" data-aos="fade-up">
                    <div class="title-section v1 style1">
                        <h1 class="title">Meet Our Partners</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($top_level_team->isEmpty())
                    <p style="text-align: center;">No team members found.</p>
                @else
                    @foreach ($top_level_team as $item)
                        <div class="col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="50" data-aos-duration="1000" style="margin-bottom: 30px;">
                            <div class="flat-team">
                                <a href="{{ route('frontend.team.details', $item->slug) }}">
                                    <div class="avatar">
                                        <img src="{{ asset($item->team_image) }}" alt="{{ $item->name }}" style="width: 100%;">
                                        <div class="overlay"></div>
                                        <div class="gallery-content">
                                            <ul class="gallery-link">
                                                <li class="icon-s FromLeft"><span><i class="fa-solid fa-link"></i></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h6 class="name">{{ $item->name }}</h6>
                                        <p class="position">{{ $item->designation }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- Meet Our Administration/Management --}}
    <section class="flat-row v7 Teammember">
        <div class="container">
            <div class="row">
                <div class="col-md-12" data-aos="fade-up">
                    <div class="title-section v1 style1">
                        <h1 class="title">Meet Our Administration/Management</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($middle_level_team->isEmpty())
                    <p style="text-align: center;">No team members found.</p>
                @else
                    @foreach ($middle_level_team as $item)
                        <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="50" data-aos-duration="1000">
                            <div class="flat-team">
                                <a href="{{ route('frontend.team.details', $item->slug) }}">
                                    <div class="avatar">
                                        <img src="{{ asset($item->team_image) }}" alt="{{ $item->name }}" style="width: 100%;">
                                        <div class="overlay"></div>
                                        <div class="gallery-content">
                                            <ul class="gallery-link">
                                                <li class="icon-s FromLeft"><span><i class="fa-solid fa-link"></i></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h6 class="name">{{ $item->name }}</h6>
                                        <p class="position">{{ $item->designation }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- Meet Our Team --}}
    <section class="flat-row v7 Teammember bg-theme">
        <div class="container">
            <div class="row">
                <div class="col-md-12" data-aos="fade-up">
                    <div class="title-section v1 style1">
                        <h1 class="title">Meet Our Team</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($student_level_team->isEmpty())
                    <p style="text-align: center;">No team members found.</p>
                @else
                    @foreach ($student_level_team as $item)
                        <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="50" data-aos-duration="1000">
                            <div class="flat-team">
                                <a href="{{ route('frontend.team.details', $item->slug) }}">
                                    <div class="avatar">
                                        <img src="{{ asset($item->team_image) }}" alt="{{ $item->name }}" style="width: 100%;">
                                        <div class="overlay"></div>
                                        <div class="gallery-content">
                                            <ul class="gallery-link">
                                                <li class="icon-s FromLeft">
                                                    <span><i class="fa-solid fa-link"></i></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h6 class="name">{{ $item->name }}</h6>
                                        <p class="position">{{ $item->designation }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

@endsection
