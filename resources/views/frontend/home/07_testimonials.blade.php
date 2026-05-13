<section class="testimonial-two testimonial-page-custom" style="background-color: #ffffff; padding: 80px 0;">

    <div class="testimonial-two-bg-shape" style="background-image: url({{ asset('frontend/assets/images/shapes/testimonial-two-bg-shape.png') }});"></div>

    <div class="container">

        <div class="section-title text-center sec-title-animation animation-style1">
            <div class="section-title__tagline-box">
                <span class="section-title__tagline">Testimonials</span>
            </div>
            <h2 class="section-title__title title-animation">What Our Customer <span>Says?</span></h2>
        </div>

        <div class="testimonial-two__carousel owl-theme owl-carousel">

            @foreach ($testimonials as $item)
                <div class="item">
                    <div class="testimonial-two__single" style="background-color: #ffffff; border-radius: 12px; padding: 35px 30px 30px; position: relative; box-shadow: none;">
                        <div class="testimonial-two__single-bdr"></div>

                        {{-- Star Rating - Top --}}
                        <div class="testimonial-two__client-ratting" style="margin-bottom: 18px;">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $item->rating)
                                    <span class="icon-star-1"></span>
                                @else
                                    <span class="icon-star-1" style="opacity: 0.3;"></span>
                                @endif
                            @endfor
                        </div>

                        {{-- Review Text --}}
                        <p class="testimonial-two__text" style="color: #555; font-size: 15px; line-height: 1.8; margin-bottom: 25px;">{{ $item->review_text }}</p>

                        {{-- Client Info - Bottom --}}
                        <div class="testimonial-two__client-info-box" style="display: flex; align-items: center; justify-content: space-between;">
                            <div class="testimonial-two__client-info" style="display: flex; align-items: center; gap: 14px;">
                                <div class="testimonial-two__client-img-box">
                                    <div class="testimonial-two__client-img" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; border: 2px solid #d0d6e8;">
                                        <img src="{{ asset($item->client_image) }}" alt="{{ $item->client_name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </div>
                                <div class="testimonial-two__client-content">
                                    <h3 class="testimonial-two__client-name" style="font-size: 16px; font-weight: 700; margin-bottom: 2px; color: #1a1a2e;">{{ $item->client_name }}</h3>
                                    <p class="testimonial-two__client-sub-title" style="font-size: 13px; color: #777; margin: 0;">{{ $item->client_designation }}</p>
                                </div>
                            </div>

                            {{-- Quote Icon - Bottom Right --}}
                            <div style="font-size: 38px; color: #d0d6e8; line-height: 1;">
                                <span class="fas fa-quote-right"></span>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>

        <div class="row">
            <div class="col-12 text-center mt-5">
                <div class="about-one__btn-box">
                    <a href="{{ route('frontend.testimonials') }}" class="thm-btn">
                        View All Testimonials<span class="fas fa-arrow-right"></span>
                    </a>
                </div>
            </div>
        </div>

    </div>

</section>
