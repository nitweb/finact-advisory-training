<section class="about-one">

    <div class="about-one__shape-2 float-bob">
        <img src="{{ asset('frontend/assets/images/shapes/about-one-shape-2.png') }}" alt="">
    </div>

    <div class="about-one__shape-3 float-bob-y">
        <img src="{{ asset('frontend/assets/images/shapes/about-one-shape-3.png') }}" alt="">
    </div>

    <div class="container">

        <div class="row">

            <div class="col-xl-6" style="display: flex; align-items: center;">
                <div class="about-three__left wow slideInLeft" data-wow-delay="100ms" data-wow-duration="2500ms">
                    <div class="about-three__img-box">
                        <div class="about-one__shape-1 float-bob-x">
                            <img src="{{ asset('frontend/assets/images/shapes/about-one-shape-1.png') }}" alt="">
                        </div>
                        <div class="about-three__img">
                            <img src="{{ asset('uploads/static_images/finace_support.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">

                <div class="about-three__right">

                    <div class="section-title text-left sec-title-animation animation-style2">

                        <div class="section-title__tagline-box">
                            <span class="section-title__tagline">Global Remote Finance Support</span>
                        </div>

                        <h2 class="section-title__title title-animation">
                            <span>Reliable</span> Finance Operations Across <span>Locations</span>
                        </h2>

                    </div>

                    <p class="about-one__text">
                        We provide structured remote finance support for international organizations, ensuring consistency in accounting, reporting, and compliance processes.
                    </p>

                    <br>

                    <p class="about-one__text">
                        Our approach combines disciplined workflows, secure system usage, and clear communication to support operations across different time zones.
                    </p>

                    <br>

                    <ul class="why-choose-three__points list-unstyled">
                        <li>
                            <div class="icon"><i class="fas fa-check-circle"></i></div>
                            <p>Structured accounting and reporting.</p>
                        </li>
                        <li>
                            <div class="icon"><i class="fas fa-check-circle"></i></div>
                            <p>Cloud-based system support (QuickBooks, Xero).</p>
                        </li>
                        <li>
                            <div class="icon"><i class="fas fa-check-circle"></i></div>
                            <p>Consistent process and reporting discipline.</p>
                        </li>
                        <li>
                            <div class="icon"><i class="fas fa-check-circle"></i></div>
                            <p>Support for international operations.</p>
                        </li>
                    </ul>

                    <br>

                    <div class="about-one__btn-and-client-info">
                        <div class="about-one__btn-box">
                            <a href="{{ route('frontend.remote.support') }}" class="thm-btn">Explore Global Services
                                <span class="fas fa-arrow-right"></span>
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
