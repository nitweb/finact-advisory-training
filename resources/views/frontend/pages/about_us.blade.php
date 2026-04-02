@extends('frontend.dashboard')
@section('frontend_title', 'About Us')
@section('frontend_content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('frontend/assets/images/backgrounds/page-header-bg.jpg') }});"></div>
        <div class="container">
            <div class="page-header__inner">
                <h3>About Us</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--About One Start -->
    <section class="about-one">
        <div class="about-one__shape-2 float-bob">
            <img src="assets/images/shapes/about-one-shape-2.png" alt="">
        </div>
        <div class="about-one__shape-3 float-bob-y">
            <img src="assets/images/shapes/about-one-shape-3.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="about-one__left">
                        <div class="section-title text-left sec-title-animation animation-style2">
                            <div class="section-title__tagline-box">
                                <span class="section-title__tagline">About Us</span>
                            </div>
                            <h2 class="section-title__title title-animation">Boost Business with Our <br> Innovative
                                <span> IT Solutions</span>
                            </h2>
                        </div>
                        <p class="about-one__text">Innovating and empowering businesses with tailored solutions for
                            success<br> and growth. Empowering businesses to create meaningful innovation.</p>
                        <ul class="about-one__points list-unstyled">
                            <li>
                                <div class="icon">
                                    <span class="icon-award"></span>
                                </div>
                                <div class="content">
                                    <h4>Award-Winning Company.</h4>
                                    <p>Partner with us to unlock new possibilities, drive progress, and shape<br> a
                                        future filled with success</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-certified"></span>
                                </div>
                                <div class="content">
                                    <h4>Certified Company</h4>
                                    <p>Partner with us to unlock new possibilities, drive progress, and shape<br> a
                                        future filled with success</p>
                                </div>
                            </li>
                        </ul>
                        <div class="about-one__btn-and-client-info">
                            <div class="about-one__btn-box">
                                <a href="about.html" class="thm-btn">Learn More
                                    <span class="fas fa-arrow-right"></span>
                                </a>
                            </div>
                            <div class="about-one__client-info-inner">
                                <div class="about-one__client-info">
                                    <div class="about-one__client-img-inner">
                                        <div class="about-one__client-img">
                                            <img src="assets/images/resources/about-one-client-img-1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="about-one__client-details">
                                        <h5>Adam Smith</h5>
                                        <p>ceo,Itzone</p>
                                    </div>
                                </div>
                                <div class="about-one__client-sign">
                                    <img src="assets/images/resources/about-one-client-sign.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="about-one__right wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <div class="about-one__img-box">
                            <div class="about-one__shape-1 float-bob-x">
                                <img src="assets/images/shapes/about-one-shape-1.png" alt="">
                            </div>
                            <div class="about-one__img">
                                <img src="assets/images/resources/about-one-img-1.jpg" alt="">
                            </div>
                            <div class="about-one__img-2">
                                <img src="assets/images/resources/about-one-img-2.jpg" alt="">
                            </div>
                            <div class="about-one__video-link">
                                <a href="https://www.youtube.com/watch?v=Get7rqXYrbQ" class="video-popup">
                                    <div class="about-one__video-icon">
                                        <span class="fa fa-play"></span>
                                        <i class="ripple"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="about-one__client-box">
                                <ul class="about-one__client-box-img-list list-unstyled">
                                    <li>
                                        <div class="about-one__client-box-img">
                                            <img src="assets/images/resources/about-one-client-img-1-1.jpg" alt="">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="about-one__client-box-img">
                                            <img src="assets/images/resources/about-one-client-img-1-2.jpg" alt="">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="about-one__client-box-img">
                                            <img src="assets/images/resources/about-one-client-img-1-3.jpg" alt="">
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#"><span class="fas fa-plus"></span></a>
                                    </li>
                                </ul>
                                <p class="about-one__client-text"><span class="odometer" data-count="120">00</span><span class="about-one__client-text-letter">K</span> Satisfied Client</p>
                            </div>
                            <div class="about-one__experience-box">
                                <div class="about-one__experience-count-box">
                                    <h3 class="odometer" data-count="25">00</h3>
                                    <span>+</span>
                                </div>
                                <p class="about-one__experience-text">Years of
                                    Experience</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--About One End -->

    <!--Service One Start -->
    <section class="service-one">
        <div class="services-one__shape-1"></div>
        <div class="services-one__shape-2 float-bob-x">
            <img src="assets/images/shapes/services-one-shape-2.png" alt="">
        </div>
        <div class="container">
            <div class="section-title text-center sec-title-animation animation-style1">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Our Services</span>
                </div>
                <h2 class="section-title__title title-animation">Innovative IT Services
                    <br> Tailored <span>For Your Success.</span>
                </h2>
            </div>
            <div class="service-one__carousel owl-theme owl-carousel">
                <!--Services One Single Start-->
                <div class="item">
                    <div class="service-one__single-inner">
                        <div class="service-one__single-wrap">
                            <div class="service-one__single">
                                <div class="service-one__single-shape-1"></div>
                                <div class="service-one__icon">
                                    <span class="icon-social-media-marketing"></span>
                                </div>
                                <h3 class="service-one__title"><a href="software-development.html">Software
                                        Development</a></h3>
                                <p class="service-one__text">Innovating and empowering businesses with tailored
                                    solutions for success and growth.</p>
                            </div>
                        </div>
                        <div class="service-one__btn-box">
                            <a href="software-development.html" class="thm-btn">Read More
                                <span class="fas fa-arrow-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Services One Single End-->
                <!--Services One Single Start-->
                <div class="item">
                    <div class="service-one__single-inner">
                        <div class="service-one__single-wrap">
                            <div class="service-one__single">
                                <div class="service-one__single-shape-1"></div>
                                <div class="service-one__icon">
                                    <span class="icon-financial-risk"></span>
                                </div>
                                <h3 class="service-one__title"><a href="web-development.html">Risk
                                        Management</a></h3>
                                <p class="service-one__text">Innovating and empowering businesses with tailored
                                    solutions for success and growth.</p>
                            </div>
                        </div>
                        <div class="service-one__btn-box">
                            <a href="web-development.html" class="thm-btn">Read More
                                <span class="fas fa-arrow-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Services One Single End-->
                <!--Services One Single Start-->
                <div class="item">
                    <div class="service-one__single-inner">
                        <div class="service-one__single-wrap">
                            <div class="service-one__single">
                                <div class="service-one__single-shape-1"></div>
                                <div class="service-one__icon">
                                    <span class="icon-ux-design"></span>
                                </div>
                                <h3 class="service-one__title"><a href="ui-ux-design.html">UI/UX Design</a></h3>
                                <p class="service-one__text">Innovating and empowering businesses with tailored
                                    solutions for success and growth.</p>
                            </div>
                        </div>
                        <div class="service-one__btn-box">
                            <a href="ui-ux-design.html" class="thm-btn">Read More
                                <span class="fas fa-arrow-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Services One Single End-->
                <!--Services One Single Start-->
                <div class="item">
                    <div class="service-one__single-inner">
                        <div class="service-one__single-wrap">
                            <div class="service-one__single">
                                <div class="service-one__single-shape-1"></div>
                                <div class="service-one__icon">
                                    <span class="icon-promotion"></span>
                                </div>
                                <h3 class="service-one__title"><a href="digital-marketing.html">Digital
                                        Marketing</a></h3>
                                <p class="service-one__text">Innovating and empowering businesses with tailored
                                    solutions for success and growth.</p>
                            </div>
                        </div>
                        <div class="service-one__btn-box">
                            <a href="digital-marketing.html" class="thm-btn">Read More
                                <span class="fas fa-arrow-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Services One Single End-->
                <!--Services One Single Start-->
                <div class="item">
                    <div class="service-one__single-inner">
                        <div class="service-one__single-wrap">
                            <div class="service-one__single">
                                <div class="service-one__single-shape-1"></div>
                                <div class="service-one__icon">
                                    <span class="icon-implement"></span>
                                </div>
                                <h3 class="service-one__title"><a href="software-development.html">Cloud
                                        Provider</a></h3>
                                <p class="service-one__text">Innovating and empowering businesses with tailored
                                    solutions for success and growth.</p>
                            </div>
                        </div>
                        <div class="service-one__btn-box">
                            <a href="software-development.html" class="thm-btn">Read More
                                <span class="fas fa-arrow-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Services One Single End-->
                <!--Services One Single Start-->
                <div class="item">
                    <div class="service-one__single-inner">
                        <div class="service-one__single-wrap">
                            <div class="service-one__single">
                                <div class="service-one__single-shape-1"></div>
                                <div class="service-one__icon">
                                    <span class="icon-monitor"></span>
                                </div>
                                <h3 class="service-one__title"><a href="business-analysis.html">Data Analytics</a>
                                </h3>
                                <p class="service-one__text">Innovating and empowering businesses with tailored
                                    solutions for success and growth.</p>
                            </div>
                        </div>
                        <div class="service-one__btn-box">
                            <a href="business-analysis.html" class="thm-btn">Read More
                                <span class="fas fa-arrow-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Services One Single End-->
            </div>
        </div>
    </section>
    <!--Service One End -->

    <!-- Sliding Text One Start -->
    <section class="sliding-text-one">
        <div class="sliding-text-one__wrap">
            <ul class="sliding-text-one__list list-unstyled marquee_mode-1">
                <li>
                    <h2 data-hover="UI/UX Design" class="sliding-text-one__title">UI/UX Design</h2>
                    <span class="icon-star"></span>
                </li>
                <li>
                    <h2 data-hover="Product Design" class="sliding-text-one__title">Product Design</h2>
                    <span class="icon-star"></span>
                </li>
                <li>
                    <h2 data-hover="Web Development" class="sliding-text-one__title">Web Development</h2>
                    <span class="icon-star"></span>
                </li>
                <li>
                    <h2 data-hover="BRANDING" class="sliding-text-one__title">BRANDING</h2>
                    <span class="icon-star"></span>
                </li>
                <li>
                    <h2 data-hover="Cyber Security" class="sliding-text-one__title">Cyber Security</h2>
                    <span class="icon-star"></span>
                </li>
                <li>
                    <h2 data-hover="Website design" class="sliding-text-one__title">Website design</h2>
                    <span class="icon-star"></span>
                </li>
                <li>
                    <h2 data-hover="Digital Marketing" class="sliding-text-one__title">Digital Marketing</h2>
                    <span class="icon-star"></span>
                </li>
                <li>
                    <h2 data-hover="Website design" class="sliding-text-one__title">Website design</h2>
                    <span class="icon-star"></span>
                </li>
            </ul>
        </div>
    </section>
    <!-- Sliding Text One End -->

    <!--Team Two Start -->
    <section class="team-two">
        <div class="team-two__shape-1">
            <img src="assets/images/shapes/team-two-shape-1.png" alt="" class="rotate-me">
        </div>
        <div class="container">
            <div class="section-title text-center sec-title-animation animation-style1">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Our Expert Team</span>
                </div>
                <h2 class="section-title__title title-animation">See Our Skilled Expert <span>Team</span>
                </h2>
            </div>
            <div class="team-two__carousel owl-theme owl-carousel">
                <!-- Team Two Single Start -->
                <div class="item">
                    <div class="team-two__single">
                        <div class="team-two__img-box">
                            <div class="team-two__img">
                                <img src="assets/images/team/team-2-1.jpg" alt="">
                            </div>
                        </div>
                        <div class="team-two__content-inner">
                            <div class="team-two__content">
                                <h3 class="team-two__title"><a href="team-details.html">Alisha Martin</a></h3>
                                <p class="team-two__sub-title">Cheif Expert</p>
                            </div>
                            <div class="team-two__arrow-and-social">
                                <div class="team-two__arrow">
                                    <span class="icon-share"></span>
                                </div>
                                <ul class="team-two__social list-unstyled">
                                    <li>
                                        <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-twitter-1"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-pinterest"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-linkedin"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team Two Single End -->
                <!-- Team Two Single Start -->
                <div class="item">
                    <div class="team-two__single">
                        <div class="team-two__img-box">
                            <div class="team-two__img">
                                <img src="assets/images/team/team-2-2.jpg" alt="">
                            </div>
                        </div>
                        <div class="team-two__content-inner">
                            <div class="team-two__content">
                                <h3 class="team-two__title"><a href="team-details.html">Devid Coper</a></h3>
                                <p class="team-two__sub-title">Product Designer</p>
                            </div>
                            <div class="team-two__arrow-and-social">
                                <div class="team-two__arrow">
                                    <span class="icon-share"></span>
                                </div>
                                <ul class="team-two__social list-unstyled">
                                    <li>
                                        <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-twitter-1"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-pinterest"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-linkedin"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team Two Single End -->
                <!-- Team Two Single Start -->
                <div class="item">
                    <div class="team-two__single">
                        <div class="team-two__img-box">
                            <div class="team-two__img">
                                <img src="assets/images/team/team-2-3.jpg" alt="">
                            </div>
                        </div>
                        <div class="team-two__content-inner">
                            <div class="team-two__content">
                                <h3 class="team-two__title"><a href="team-details.html">Naila Dev</a></h3>
                                <p class="team-two__sub-title">UI/UX Designer</p>
                            </div>
                            <div class="team-two__arrow-and-social">
                                <div class="team-two__arrow">
                                    <span class="icon-share"></span>
                                </div>
                                <ul class="team-two__social list-unstyled">
                                    <li>
                                        <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-twitter-1"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-pinterest"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-linkedin"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team Two Single End -->
                <!-- Team Two Single Start -->
                <div class="item">
                    <div class="team-two__single">
                        <div class="team-two__img-box">
                            <div class="team-two__img">
                                <img src="assets/images/team/team-2-4.jpg" alt="">
                            </div>
                        </div>
                        <div class="team-two__content-inner">
                            <div class="team-two__content">
                                <h3 class="team-two__title"><a href="team-details.html">Robert Martin</a></h3>
                                <p class="team-two__sub-title">CEO & Founder</p>
                            </div>
                            <div class="team-two__arrow-and-social">
                                <div class="team-two__arrow">
                                    <span class="icon-share"></span>
                                </div>
                                <ul class="team-two__social list-unstyled">
                                    <li>
                                        <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-twitter-1"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-pinterest"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-linkedin"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team Two Single End -->
                <!-- Team Two Single Start -->
                <div class="item">
                    <div class="team-two__single">
                        <div class="team-two__img-box">
                            <div class="team-two__img">
                                <img src="assets/images/team/team-2-5.jpg" alt="">
                            </div>
                        </div>
                        <div class="team-two__content-inner">
                            <div class="team-two__content">
                                <h3 class="team-two__title"><a href="team-details.html">Kevin Martis </a></h3>
                                <p class="team-two__sub-title">Chief Officer</p>
                            </div>
                            <div class="team-two__arrow-and-social">
                                <div class="team-two__arrow">
                                    <span class="icon-share"></span>
                                </div>
                                <ul class="team-two__social list-unstyled">
                                    <li>
                                        <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-twitter-1"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-pinterest"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-linkedin"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team Two Single End -->
                <!-- Team Two Single Start -->
                <div class="item">
                    <div class="team-two__single">
                        <div class="team-two__img-box">
                            <div class="team-two__img">
                                <img src="assets/images/team/team-2-6.jpg" alt="">
                            </div>
                        </div>
                        <div class="team-two__content-inner">
                            <div class="team-two__content">
                                <h3 class="team-two__title"><a href="team-details.html">Anila Koper</a></h3>
                                <p class="team-two__sub-title">Software Engineer</p>
                            </div>
                            <div class="team-two__arrow-and-social">
                                <div class="team-two__arrow">
                                    <span class="icon-share"></span>
                                </div>
                                <ul class="team-two__social list-unstyled">
                                    <li>
                                        <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-twitter-1"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-pinterest"></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-linkedin"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team Two Single End -->
            </div>
        </div>
    </section>
    <!--Team Two End -->

    <!-- Counter Two Start -->
    <section class="counter-two">
        <div class="counter-two__bg-shape float-bob-y" style="background-image: url(assets/images/shapes/counter-two-bg-shape.png);"></div>
        <div class="container">
            <div class="row">
                <!--Counter Two Single Start-->
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="100ms">
                    <div class="counter-two__single">
                        <div class="counter-two__icon">
                            <span class="icon-trophy"></span>
                        </div>
                        <div class="counter-two__content">
                            <div class="counter-two__count-box">
                                <h3 class="odometer" data-count="120">00</h3>
                                <span>+</span>
                            </div>
                            <p class="counter-two__text">award Winning</p>
                        </div>
                    </div>
                </div>
                <!--Counter Two Single End-->
                <!--Counter Two Single Start-->
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="200ms">
                    <div class="counter-two__single">
                        <div class="counter-two__icon">
                            <span class="icon-costumer"></span>
                        </div>
                        <div class="counter-two__content">
                            <div class="counter-two__count-box">
                                <h3 class="odometer" data-count="99">00</h3>
                                <span>%</span>
                            </div>
                            <p class="counter-two__text">Satisfied client</p>
                        </div>
                    </div>
                </div>
                <!--Counter Two Single End-->
                <!--Counter Two Single Start-->
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="300ms">
                    <div class="counter-two__single">
                        <div class="counter-two__icon">
                            <span class="icon-rating"></span>
                        </div>
                        <div class="counter-two__content">
                            <div class="counter-two__count-box">
                                <h3 class="odometer" data-count="10">00</h3>
                                <span>M</span>
                            </div>
                            <p class="counter-two__text">worldwide reviews</p>
                        </div>
                    </div>
                </div>
                <!--Counter Two Single End-->
                <!--Counter Two Single Start-->
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="400ms">
                    <div class="counter-two__single">
                        <div class="counter-two__icon">
                            <span class="icon-customer"></span>
                        </div>
                        <div class="counter-two__content">
                            <div class="counter-two__count-box">
                                <h3 class="odometer" data-count="200">00</h3>
                                <span>+</span>
                            </div>
                            <p class="counter-two__text">Happy Clients</p>
                        </div>
                    </div>
                </div>
                <!--Counter Two Single End-->
            </div>
        </div>
    </section>
    <!-- Counter Two End -->

    <!--Testimonial Two Start-->
    <section class="testimonial-two">
        <div class="testimonial-two-bg-shape" style="background-image: url(assets/images/shapes/testimonial-two-bg-shape.png);"></div>
        <div class="container">
            <div class="section-title text-center sec-title-animation animation-style1">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Testimonials</span>
                </div>
                <h2 class="section-title__title title-animation">What Our Customer <span>Says?</span>
                </h2>
            </div>
            <div class="testimonial-two__carousel owl-theme owl-carousel">
                <!--Testimonial Two Single Start-->
                <div class="item">
                    <div class="testimonial-two__single">
                        <div class="testimonial-two__single-bdr"></div>
                        <div class="testimonial-two__quote">
                            <span class="fas fa-quote-right"></span>
                        </div>
                        <div class="testimonial-two__client-info-box">
                            <div class="testimonial-two__client-info">
                                <div class="testimonial-two__client-img-box">
                                    <div class="testimonial-two__client-img">
                                        <img src="assets/images/testimonial/testimonial-2-1.jpg" alt="">
                                    </div>
                                </div>
                                <div class="testimonial-two__client-content">
                                    <h3 class="testimonial-two__client-name"><a href="testimonials.html">Adam
                                            Smith</a></h3>
                                    <p class="testimonial-two__client-sub-title">Co-Founder</p>
                                </div>
                            </div>
                            <div class="testimonial-two__client-ratting">
                                <span class="icon-star-1"></span>
                                <span class="icon-star-1"></span>
                                <span class="icon-star-1"></span>
                                <span class="icon-star-1"></span>
                                <span class="icon-star-1"></span>
                            </div>
                        </div>
                        <p class="testimonial-two__text">“Adipiscing elit, sed do eiusmod tempor incididunt ut
                            labored etos dolore magna aliquant. Ut enim ad minim veniam nostrud exercitation
                            ullamco laboris nisi ut aliquip</p>
                    </div>
                </div>
                <!--Testimonial Two Single End-->
                <!--Testimonial Two Single Start-->
                <div class="item">
                    <div class="testimonial-two__single">
                        <div class="testimonial-two__single-bdr"></div>
                        <div class="testimonial-two__quote">
                            <span class="fas fa-quote-right"></span>
                        </div>
                        <div class="testimonial-two__client-info-box">
                            <div class="testimonial-two__client-info">
                                <div class="testimonial-two__client-img-box">
                                    <div class="testimonial-two__client-img">
                                        <img src="assets/images/testimonial/testimonial-2-2.jpg" alt="">
                                    </div>
                                </div>
                                <div class="testimonial-two__client-content">
                                    <h3 class="testimonial-two__client-name"><a href="testimonials.html">Robert
                                            Son</a></h3>
                                    <p class="testimonial-two__client-sub-title">Co-Founder</p>
                                </div>
                            </div>
                            <div class="testimonial-two__client-ratting">
                                <span class="icon-star-1"></span>
                                <span class="icon-star-1"></span>
                                <span class="icon-star-1"></span>
                                <span class="icon-star-1"></span>
                                <span class="icon-star-1"></span>
                            </div>
                        </div>
                        <p class="testimonial-two__text">“Adipiscing elit, sed do eiusmod tempor incididunt ut
                            labored etos dolore magna aliquant. Ut enim ad minim veniam nostrud exercitation
                            ullamco laboris nisi ut aliquip</p>
                    </div>
                </div>
                <!--Testimonial Two Single End-->
                <!--Testimonial Two Single Start-->
                <div class="item">
                    <div class="testimonial-two__single">
                        <div class="testimonial-two__single-bdr"></div>
                        <div class="testimonial-two__quote">
                            <span class="fas fa-quote-right"></span>
                        </div>
                        <div class="testimonial-two__client-info-box">
                            <div class="testimonial-two__client-info">
                                <div class="testimonial-two__client-img-box">
                                    <div class="testimonial-two__client-img">
                                        <img src="assets/images/testimonial/testimonial-2-3.jpg" alt="">
                                    </div>
                                </div>
                                <div class="testimonial-two__client-content">
                                    <h3 class="testimonial-two__client-name"><a href="testimonials.html">Alisha
                                            Martin</a></h3>
                                    <p class="testimonial-two__client-sub-title">Co-Founder</p>
                                </div>
                            </div>
                            <div class="testimonial-two__client-ratting">
                                <span class="icon-star-1"></span>
                                <span class="icon-star-1"></span>
                                <span class="icon-star-1"></span>
                                <span class="icon-star-1"></span>
                                <span class="icon-star-1"></span>
                            </div>
                        </div>
                        <p class="testimonial-two__text">“Adipiscing elit, sed do eiusmod tempor incididunt ut
                            labored etos dolore magna aliquant. Ut enim ad minim veniam nostrud exercitation
                            ullamco laboris nisi ut aliquip</p>
                    </div>
                </div>
                <!--Testimonial Two Single End-->
            </div>
        </div>
    </section>
    <!--Testimonial Two End-->

    <!-- Blog One Start -->
    <section class="blog-one">
        <div class="blog-one__shape-1"></div>
        <div class="blog-one__shape-2"></div>
        <div class="blog-one__shape-3 float-bob">
            <img src="assets/images/shapes/blog-one-shape-3.png" alt="">
        </div>
        <div class="container">
            <div class="section-title text-center sec-title-animation animation-style1">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Our Blogs</span>
                </div>
                <h2 class="section-title__title title-animation">Latest News & Articles From
                    <br> The <span>Blog Posts</span>
                </h2>
            </div>
            <div class="row">
                <!--Blog One Single Start-->
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="100ms">
                    <div class="blog-one__single">
                        <div class="blog-one__img">
                            <img src="assets/images/blog/blog-1-1.jpg" alt="">
                            <div class="blog-one__tags">
                                <span>Digital</span>
                                <span>Technology</span>
                            </div>
                        </div>
                        <div class="blog-one__content">
                            <div class="blog-one__user">
                                <div class="blog-one__user-img">
                                    <img src="assets/images/blog/blog-one-user-1.jpg" alt="">
                                </div>
                                <p class="blog-one__user-title">Malaika alise</p>
                            </div>
                            <ul class="blog-one__meta list-unstyled">
                                <li>
                                    <a href="blog-details.html"><span class="far fa-calendar-alt"></span>April 5,
                                        2025</a>
                                </li>
                                <li>
                                    <a href="blog-details.html"><span class="fal fa-comments"></span>80
                                        Comments</a>
                                </li>
                            </ul>
                            <h3 class="blog-one__title"><a href="blog-details.html">Improving Business Growth with
                                    New<br> Technology</a></h3>
                            <p class="blog-one__text">Winning the Digital business The 2025 Transformation
                                Roadmap. Holisticly leverage existing magnetic. Next-Gen Digital Transformation</p>
                            <div class="blog-one__btn-box">
                                <a href="blog-details.html" class="thm-btn">Reed More
                                    <span class="fas fa-arrow-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Blog One Single End-->
                <div class="col-xl-6">
                    <!-- Blog One Single Two Start -->
                    <div class="blog-one__single-two wow fadeInUp" data-wow-delay="200ms">
                        <div class="blog-one__img-two">
                            <img src="assets/images/blog/blog-1-2.jpg" alt="">
                            <div class="blog-one__tags-two">
                                <span>Digital</span>
                                <span>Technology</span>
                            </div>
                        </div>
                        <div class="blog-one__content-two">
                            <div class="blog-one__user-two">
                                <div class="blog-one__user-two-img">
                                    <img src="assets/images/blog/blog-one-user-2.jpg" alt="">
                                </div>
                                <p class="blog-one__user-two-title">John Smith</p>
                            </div>
                            <ul class="blog-one__meta-two list-unstyled">
                                <li>
                                    <a href="blog-details.html"><span class="far fa-calendar-alt"></span>Feb 25,
                                        2025</a>
                                </li>
                                <li>
                                    <a href="blog-details.html"><span class="fal fa-comments"></span>22
                                        Comments</a>
                                </li>
                            </ul>
                            <h3 class="blog-one__title-two"><a href="blog-details.html">Regional Manager & limited
                                    management.</a></h3>
                            <p class="blog-one__text-two">Winning the Digital business The 2025 Transformation
                                Roadmap.</p>
                            <div class="blog-one__btn-box-two">
                                <a href="blog-details.html" class="thm-btn">Reed More
                                    <span class="fas fa-arrow-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Blog One Single Two End -->
                    <!-- Blog One Single Two Start -->
                    <div class="blog-one__single-two wow fadeInUp" data-wow-delay="300ms">
                        <div class="blog-one__img-two">
                            <img src="assets/images/blog/blog-1-3.jpg" alt="">
                            <div class="blog-one__tags-two">
                                <span>Digital</span>
                                <span>Technology</span>
                            </div>
                        </div>
                        <div class="blog-one__content-two">
                            <div class="blog-one__user-two">
                                <div class="blog-one__user-two-img">
                                    <img src="assets/images/blog/blog-one-user-3.jpg" alt="">
                                </div>
                                <p class="blog-one__user-two-title">Jerin jara</p>
                            </div>
                            <ul class="blog-one__meta-two list-unstyled">
                                <li>
                                    <a href="blog-details.html"><span class="far fa-calendar-alt"></span>May 19,
                                        2025</a>
                                </li>
                                <li>
                                    <a href="blog-details.html"><span class="fal fa-comments"></span>15
                                        Comments</a>
                                </li>
                            </ul>
                            <h3 class="blog-one__title-two"><a href="blog-details.html">Easy and Most Powerful
                                    Server and Platform.</a></h3>
                            <p class="blog-one__text-two">Winning the Digital business The 2025 Transformation
                                Roadmap.</p>
                            <div class="blog-one__btn-box-two">
                                <a href="blog-details.html" class="thm-btn">Reed More
                                    <span class="fas fa-arrow-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Blog One Single Two End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Blog One End -->

    <!-- Newsletter One Start -->
    <section class="newsletter-two">
        <div class="container">
            <div class="newsletter-two__inner">
                <div class="newsletter-two__shape-1" style="background-image: url(assets/images/shapes/newsletter-two-shape-1.png);"></div>
                <div class="newsletter-two__img-1">
                    <img src="assets/images/resources/newsletter-two-img-1.png" alt="">
                </div>
                <div class="newsletter-two__left">
                    <h2 class="newsletter-two__title">Subcribe to Our Newsletter</h2>
                    <p class="newsletter-two__text">Get the latest SEO tips and software insights straight to your
                        inbox.</p>
                </div>
                <div class="newsletter-two__right">
                    <form class="contact-form-validated newsletter-two__form" action="assets/inc/sendemail.php" method="post">
                        <div class="newsletter-two__input">
                            <input type="email" placeholder="Enter email address" name="email" required>
                        </div>
                        <button type="submit" class="thm-btn">Subscribe Now <span class="fas fa-arrow-right"></span>
                        </button>
                        <div class="result"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter One End -->

@endsection
