<section class="flat-row v16 choose-us2">

    <div class="container">

        <div class="row">

            <div class="col-md-12" data-aos="fade-up">

                <div class="title-section style1">

                    <h1 class="title">About Our Company</h1>

                </div>

            </div>

        </div>

        <div class="row align-items-center">

            <div class="col-md-6 ove-hide" data-aos="fade-right" data-aos-delay="50" data-aos-duration="1000">

                <div class="divider h31">

                </div>

                <div class="wrap-iconbox">

                    <div class="iconbox compact left style2 maxwidth">

                        <div class="box-content" style="text-align: justify;">

                            <p>{!! Str::limit($about_us->description, 950) !!}</p>

                        </div>

                        <div class="widgets-header-information" style="margin-top: 20px;">
                            <div class="informaiton-text">
                                <div class="info-icon">
                                    <div class="btn-click">
                                        <a href="{{ route('frontend.about.us') }}" class="btn-black">See More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-6 ove-hide" data-aos="fade-left" data-aos-delay="50" data-aos-duration="1000">
                <div class="choseus">
                    <img src="{{ asset($about_us->about_us_image) }}" alt="image">
                </div>
            </div>

        </div>

    </div>

</section>
