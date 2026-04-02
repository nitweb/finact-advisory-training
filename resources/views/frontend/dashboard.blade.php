<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('frontend_title') | Finact Advisory Training</title>

    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/assets/images/favicons/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/assets/images/favicons/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/assets/images/favicons/favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('frontend/assets/images/favicons/site.webmanifest') }}" />
    <meta name="description" content="Itzone HTML 5 Template " />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom-animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome-all.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jarallax.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery.magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/odometer.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/twentytwenty.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/aos.css') }}" />

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/banner.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/about.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/services.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/why-choose.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/process.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/sliding-text.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/project.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/counter.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/team.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/brand.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/testimonial.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/contact.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/pricing.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/faq.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/blog.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/newsletter.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/video.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/feature.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/error.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/module-css/page-header.css') }}" />

    <!-- template styles -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}?v={{ time() }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}" />

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}?v={{ time() }}" />

</head>

<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="chat-icon"><button type="button" class="chat-toggler"><i class="fa fa-comment"></i></button></div>

    <!--Chat Popup-->
    @include('frontend.layouts.chat_popup')

    <div class="page-wrapper">

        {{-- Header Section --}}
        @include('frontend.layouts.header')

        {{-- Sticky Header --}}
        <div class="stricky-header stricked-menu main-menu main-menu-three">
            <div class="sticky-header__content"></div>
        </div>

        {{-- Index Area --}}
        @yield('frontend_content')

        {{-- Footer Section --}}
        @include('frontend.layouts.footer')

    </div>

    {{-- Mobile Nev --}}
    @include('frontend.layouts.mobile_nav')

    {{-- Search Popup --}}
    @include('frontend.layouts.search_popup')

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
        <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
        <span class="scroll-to-top__text"> Go Back Top</span>
    </a>

    <script src="{{ asset('frontend/assets/js/jquery-latest.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jarallax.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.circle-progress.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/knob.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wNumb.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.circleType.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.lettering.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.fittext.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/marquee.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-sidebar-content.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/twentytwenty.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.event.move.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/aos.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/gsap/gsap.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/gsap/ScrollTrigger.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/gsap/SplitText.js') }}"></script>

    <!-- template js -->
    <script src="{{ asset('frontend/assets/js/script.js') }}?v={{ time() }}"></script>
</body>

</html>
