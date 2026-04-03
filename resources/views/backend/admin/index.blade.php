@extends('backend.admin.master')

@section('admin_title', 'Dashboard')

@section('admin_content')

    <style>
        .custom_dashboard_title {
            color: var(--bs-body-color);
        }

        .stats-card {
            transition: all 0.25s ease-in-out;
            border-radius: 12px;
        }

        a .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .icon-box {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bg-gradient-primary {
            background: linear-gradient(45deg, #007bff, #00b4ff);
        }

        .bg-gradient-success {
            background: linear-gradient(45deg, #28a745, #85e085);
        }

        .bg-gradient-warning {
            background: linear-gradient(45deg, #ffc107, #ffb347);
        }

        .bg-gradient-danger {
            background: linear-gradient(45deg, #dc3545, #ff6b6b);
        }

        a {
            color: inherit;
        }

        a:hover {
            text-decoration: none;
        }

        a .stats-card {
            cursor: pointer;
        }

        .gradient-banner {
            background: linear-gradient(90deg, #163355, #b89867);
            border-radius: 15px;
        }

        .hover-scale {
            transition: all 0.25s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(255, 255, 255, 0.3);
        }

        .visit_card_btn{
            background-color: #163355;
            border-color: #163355;
        }

        .visit_card_btn:hover{
            background-color: #fff !important;
        }
    </style>

    <div class="main-content">

        <section class="section">

            {{-- Breadcrumb --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Dabo Bunny</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Frontend Visit Card --}}
            <div class="row mb-3 mt-3">
                <div class="col-12">
                    <div class="card border-0 shadow-sm gradient-banner text-white p-4 d-flex flex-md-row flex-column align-items-center justify-content-between">
                        <div class="mb-3 mb-md-0">
                            <h4 class="fw-bold mb-1 text-white">View Your Website</h4>
                            <p class="mb-0 opacity-75">Click below to open the live frontend of your site.</p>
                        </div>
                        <a href="{{ route('frontend.index') }}" target="_blank" class="btn btn-light text-primary fw-semibold px-4 py-2 rounded-pill shadow-sm hover-scale visit_card_btn">
                            🌐 Visit Frontend
                        </a>
                    </div>
                </div>
            </div>

            <div class="row ">

                {{-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-20"><a href="{{ route('admin.slider.list') }}" class="custom_dashboard_title">Home Sliders</a></h5>
                                            <h2 class="mb-3 font-18">{{ $slider->count() }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('/backend/assets/img/banner/1.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-20"><a href="{{ route('admin.about-us.list') }}" class="custom_dashboard_title">About Our Firm</a></h5>
                                            <h2 class="mb-3 font-18">{{ $about_us->count() }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('/backend/assets/img/banner/about_us.svg') }}" style="width: 140px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-20"><a href="{{ url('admin/about-message/list') }}" class="custom_dashboard_title">Managing Partner Message</a></h5>
                                            <h2 class="mb-3 font-18">{{ $chairman_message->count() }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('/backend/assets/img/banner/chairman_message.svg') }}" style="width: 140px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-20"><a href="{{ route('admin.our-team.list') }}" class="custom_dashboard_title">Our Team</a></h5>
                                            <h2 class="mb-3 font-18">{{ $our_team->count() }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('/backend/assets/img/banner/our_team.svg') }}" style="width: 140px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-20"><a href="{{ route('admin.service.list') }}" class="custom_dashboard_title">Services</a></h5>
                                            <h2 class="mb-3 font-18">{{ $service->count() }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('/backend/assets/img/banner/services.svg') }}" style="width: 140px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-20"><a href="{{ route('admin.gallery.list') }}" class="custom_dashboard_title">Gallery</a></h5>
                                            <h2 class="mb-3 font-18">{{ $galleries->count() }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('/backend/assets/img/banner/blog.svg') }}" style="width: 140px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-20"><a href="{{ route('admin.contact.list') }}" class="custom_dashboard_title">Contact Messages</a></h5>
                                            <h2 class="mb-3 font-18">{{ $contact_message->count() }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('/backend/assets/img/banner/contact_messages.svg') }}" style="width: 140px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-20"><a href="{{ route('admin.setting.edit', siteSetting()->id) }}" class="custom_dashboard_title">Site Setting</a></h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('/backend/assets/img/banner/site_settings.svg') }}" style="width: 140px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </div>

@endsection
