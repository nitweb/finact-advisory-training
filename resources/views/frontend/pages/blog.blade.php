@extends('frontend.dashboard')
@section('frontend_title', 'Insights & Updates')

@section('frontend_content')

    <style>
        /* Equal height cards */
        .blog-page .row {
            display: flex;
            flex-wrap: wrap;
        }

        .blog-page .col-xl-4,
        .blog-page .col-lg-6,
        .blog-page .col-md-6 {
            display: flex;
            flex-direction: column;
            margin-bottom: 30px;
        }

        .blog-one__single {
            display: flex;
            flex-direction: column;
            flex: 1;
            height: 100%;
        }

        .blog-one__content {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        /* Description flex grow করবে — বাকি সব fixed থাকবে */
        .blog-one__text {
            flex: 1;
        }

        /* Button সবসময় নিচে */
        .blog-one__btn-box {
            margin-top: auto;
            padding-top: 16px;
        }
    </style>

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Insights & Updates</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Blog</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Blog Page Start-->
    <section class="blog-page">
        <div class="container">
            <div class="row">

                @foreach ($blog as $item)
                    <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="100ms">
                        <div class="blog-one__single">

                            <div class="blog-one__img">
                                <img src="{{ asset($item->blogDetail->blog_image) }}" alt="{{ $item->title }}">
                            </div>

                            <div class="blog-one__content">

                                <ul class="blog-one__meta list-unstyled">
                                    <li>
                                        <a href="javascript:void(0);" onclick="return false;">
                                            <span class="far fa-calendar-alt"></span>
                                            {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" onclick="return false;">
                                            <span class="fal fa-tag"></span>
                                            {{ $item->blogDetail->category->name }}
                                        </a>
                                    </li>
                                </ul>

                                <h3 class="blog-one__title">
                                    <a href="{{ route('frontend.blog.details', $item->slug) }}" title="{{ $item->title }}">
                                        {{ Str::limit($item->title, 50) }}
                                    </a>
                                </h3>

                                <div class="blog-one__text" style="text-align: justify;">
                                    {{ Str::limit($item->blogDetail->short_description, 120) }}
                                </div>

                                <div class="blog-one__btn-box">
                                    <a href="{{ route('frontend.blog.details', $item->slug) }}" class="thm-btn">
                                        Read More <span class="fas fa-arrow-right"></span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Pagination --}}
                @if ($blog->lastPage() > 1)
                    <div class="blog-list__pagination" style="width:100%;">
                        <ul class="pg-pagination list-unstyled">

                            @if ($blog->onFirstPage())
                                <li class="prev disabled" style="display:none;"><span><i class="fas fa-angle-left"></i></span></li>
                            @else
                                <li class="prev"><a href="{{ $blog->previousPageUrl() }}" aria-label="Previous"><i class="fas fa-angle-left"></i></a></li>
                            @endif

                            @for ($i = 1; $i <= $blog->lastPage(); $i++)
                                <li class="count {{ $blog->currentPage() == $i ? 'active' : '' }}">
                                    <a href="{{ $blog->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            @if ($blog->hasMorePages())
                                <li class="next"><a href="{{ $blog->nextPageUrl() }}" aria-label="Next"><i class="fas fa-angle-right"></i></a></li>
                            @else
                                <li class="next disabled" style="display:none;"><span><i class="fas fa-angle-right"></i></span></li>
                            @endif

                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </section>
    <!--Blog Page End-->

@endsection
