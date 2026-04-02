<section class="services-three">

    <div class="services-three__shape-1"></div>
    <div class="services-three__shape-2 float-bob-x">
        <img src="{{ asset('frontend/assets/images/shapes/services-three-shape-2.png') }}" alt="">
    </div>

    <div class="container">

        <div class="section-title text-center sec-title-animation animation-style1">
            <div class="section-title__tagline-box">
                <span class="section-title__tagline">Core Services</span>
            </div>
            <h2 class="section-title__title title-animation">
                Strategic Solutions for <span>Financial Excellence</span>
            </h2>
        </div>

        <div class="services-two__carousel owl-theme owl-carousel">
            @foreach ($services as $item)
                <div class="item d-flex">
                    <div class="services-two__single w-100 d-flex flex-column">
                        <div class="services-two__img-box">
                            <div class="services-two__img" style="height: 250px; overflow: hidden;">
                                <img src="{{ asset($item->serviceDetail->service_image) }}" alt="{{ $item->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        <div class="services-two__content d-flex flex-column flex-grow-1">
                            <h3 class="services-two__title">
                                <a href="{{ route('frontend.service.details', $item->slug) }}">{{ $item->title }}</a>
                            </h3>
                            <p class="services-two__text flex-grow-1">{{ $item->serviceDetail->short_description }}</p>
                            <div class="services-two__plus mt-auto">
                                <a href="{{ route('frontend.service.details', $item->slug) }}"><span class="fas fa-plus"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

</section>
