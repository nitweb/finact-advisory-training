@extends('frontend.master')

@section('frontend_title', 'Our Services | Mohammad A Zaman - Chartered Accountants')

@section('frontend_content')

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb" style="background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)), url({{ asset('frontend/img/cover_blog.jpg') }});">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h1 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Blog</h1>
            <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                <li class="breadcrumb-item active text-custom-color">Blog</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Blog Start -->
    <div class="container-fluid blog">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">

                @foreach ($blog as $item)
                    <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp mb-4" data-wow-delay="0.1s">
                        <div class="blog-item rounded">
                            <a href="{{ route('frontend.blog.details', $item->slug) }}">
                                <div class="blog-img">
                                    <img src="{{ asset($item->blogDetail->blog_image) }}" class="img-fluid w-100" alt="Image">
                                </div>
                            </a>
                            <div class="blog-centent p-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="mb-0 text-muted"><i class="fa fa-calendar-alt text-primary"></i> {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</p>
                                    <a href="javascript:void(0)" class="text-muted"><span class="fa fa-comments text-primary"></span> 3 Comments</a>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <p class="mb-0 text-muted"><i class="fa fa-tag text-primary"></i> {{ $item->blogDetail->category->name }}</p>
                                </div>
                                <a href="{{ route('frontend.blog.details', $item->slug) }}" class="h5">{{ $item->title }}</a>
                                <p class="my-4 text-justify">{{ Str::limit($item->blogDetail->short_description, 150) }}</p>
                                <a href="{{ route('frontend.blog.details', $item->slug) }}" class="btn btn-primary rounded-pill text-white py-2 px-4 mb-1">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Blog End -->

@endsection
