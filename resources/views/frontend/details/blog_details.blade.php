@extends('frontend.master')

@section('frontend_title', $blog->title . ' | Mohammad A Zaman - Chartered Accountants')

@section('frontend_content')

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset('frontend/img/cover_blog_details.jpg') }});">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h1 class="display-4 text-white mb-4 wow fadeInDown" data-wow-delay="0.1s">{{ $blog->title }}</h1>
        </div>
    </div>
    <!-- Header End -->


    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5">

                <div class="col-md-8 wow fadeInLeft" data-wow-delay="0.2">
                    <div class="section-title text-start custom_blog_details_left">
                        <img src="{{ asset($blog->blogDetail->blog_image) }}" alt="Blog Image" class="img-fluid mb-4">
                        <h3 class="display-6 mb-3">{{ $blog->title }}</h3>
                        <ul class="custom_auth_info mb-4">
                            <li>
                                <i class="fas fa-tag"></i>
                                <a>{{ $blog->blogDetail->category->name }}</a>
                            </li>
                            <li>
                                <i class="fas fa-user"></i>
                                <a>{{ $author ?? 'N/A' }}</a>
                            </li>
                            <li>
                                <i class="fas fa-calendar-alt"></i>
                                <a>{{ \Carbon\Carbon::parse($blog->date)->format('F j, Y') }}</a>
                            </li>
                        </ul>
                        <!-- Social Media Share Start -->
                        <div class="social-share mb-4">
                            <h6>Share this post:</h6>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-primary btn-sm me-2 text-white">
                                <i class="fab fa-facebook-f text-white"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title) }}" target="_blank" class="btn btn-info btn-sm me-2 text-white">
                                <i class="fab fa-twitter text-white"></i> Twitter
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($blog->title) }}" target="_blank" class="btn btn-secondary btn-sm me-2 text-white">
                                <i class="fab fa-linkedin-in text-white"></i> LinkedIn
                            </a>
                            <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{ asset($blog->blogDetail->blog_image) }}&description={{ urlencode($blog->title) }}" target="_blank" class="btn btn-danger btn-sm">
                                <i class="fab fa-pinterest text-white"></i> Pinterest
                            </a>
                        </div>
                        <!-- Social Media Share End -->
                        <div class="row g-4 mb-5">
                            <div class="custom_description" style="text-align: justify;">
                                <p>{!! $blog->blogDetail->long_description !!}</p>
                            </div>
                        </div>
                        {{-- <div class="row g-4 align-items-center">
                            <div class="col-lg-12">
                                <div class="comments-section">
                                    <!-- Comment List -->
                                    <div class="row g-4 align-items-center mb-5">
                                        <div class="col-md-12 contact-form wow fadeInLeft" data-wow-delay="0.1s">
                                            <h5 class="text-dark mb-2">Comments (3)</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="user-img me-3" style="width: 50px; height: 50px; background-image: url('{{ asset('user_profile.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; border-radius: 50%"></div>
                                                <div>
                                                    <h5>John Wick</h5>
                                                    <p>
                                                        Very helpful! Thanks
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Comment Form -->
                                    <div class="row g-4 align-items-center mb-5">
                                        <div class="col-md-12 contact-form wow fadeInLeft" data-wow-delay="0.1s">
                                            <h5 class="text-dark mb-2">Leave A Comment</h5>
                                            <p class="mb-4">
                                                All fields marked with an asterisk (*) are required
                                            </p>
                                            <form>
                                                @csrf
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control bg-transparent border border-primary" id="name" placeholder="Your Name" name="name" required>
                                                            <label for="name">Your Name <span class="text-danger">*</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input type="email" class="form-control bg-transparent border border-primary" id="email" placeholder="Your Email" name="email">
                                                            <label for="email">Your Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-floating">
                                                            <textarea class="form-control bg-transparent border border-primary" placeholder="Leave a message here" id="message" style="height: 130px" name="message" required></textarea>
                                                            <label for="message">Your Message <span class="text-danger">*</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary text-white w-40 py-3">Post Comment</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-md-4 wow fadeInRight" data-wow-delay="0.4s">
                    <div class="sidebar">
                        <div class="sidebar_search widget">
                            <form>
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-transparent" id="search" placeholder="Search..." name="search">
                                    <label for="search">Search...</label>
                                </div>
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="sidebar_posts widget">
                            <h4 class="text-dark mb-4">Recent Blog</h4>
                            @php
                                $blog_sidebar = App\Models\Blog::where('status', 'active')->latest()->take(4)->get();
                            @endphp
                            @foreach ($blog_sidebar as $item)
                                <div class="sidebar_post_item">
                                    <div class="sidebar_post_item_image">
                                        <a href="{{ route('frontend.blog.details', $item->slug) }}"><img src="{{ asset($item->blogDetail->blog_image) }}" alt="image" class="img-fluid"></a>
                                    </div>
                                    <div class="sidebar_post_item_content">
                                        <h6><a href="{{ route('frontend.blog.details', $item->slug) }}" class="text-dark">{{ $item->title }}</a></h6>
                                        <span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="sidebar_posts widget">
                            <h4 class="text-dark mb-4">Our Services</h4>
                            @php
                                $services_sidebar = App\Models\Service::where('status', 'active')->take(4)->latest()->get();
                            @endphp
                            @if ($services_sidebar->count() > 0)
                                @foreach ($services_sidebar as $item)
                                    <div class="sidebar_post_item">
                                        <div class="sidebar_post_item_image">
                                            <a href="{{ route('frontend.service.details', $item->slug) }}"><img src="{{ asset($item->serviceDetail->service_image) }}" alt="image" class="img-fluid"></a>
                                        </div>
                                        <div class="sidebar_post_item_content">
                                            <h6><a href="{{ route('frontend.service.details', $item->slug) }}" class="text-dark">{{ $item->title }}</a></h6>
                                            <span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center">
                                    <p class="text-muted">No service available.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
