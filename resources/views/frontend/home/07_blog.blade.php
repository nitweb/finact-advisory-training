<section class="blog-one blog-two blog-three">

    <div class="blog-one__shape-1"></div>
    <div class="blog-one__shape-2"></div>

    <div class="blog-one__shape-3 float-bob">
        <img src="{{ asset('frontend/assets/images/shapes/blog-one-shape-3.png') }}" alt="">
    </div>

    <div class="container">

        <div class="section-title text-center sec-title-animation animation-style1">

            <div class="section-title__tagline-box">
                <span class="section-title__tagline">Insights & Updates</span>
            </div>

        </div>

        <ul class="row list-unstyled">

            @foreach ($blog as $item)
                <li class="col-xl-4 col-lg-4 wow fadeInLeft" data-wow-delay="100ms">

                    <div class="blog-one__single">

                        <div class="blog-one__img">
                            <img src="{{ asset($item->blogDetail->blog_image) }}" alt="{{ $item->title }}">
                        </div>

                        <div class="blog-one__content">

                            <ul class="blog-one__meta list-unstyled">
                                <li>
                                    <a href="javascript:void(0);" onclick="return false;"><span class="far fa-calendar-alt"></span>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="return false;"><span class="fal fa-tag"></span>{{ $item->blogDetail->category->name }}</a>
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
                                <a href="{{ route('frontend.blog.details', $item->slug) }}" class="thm-btn">Reed More
                                    <span class="fas fa-arrow-right"></span>
                                </a>
                            </div>

                        </div>
                        
                    </div>

                </li>
            @endforeach

        </ul>

    </div>

</section>
