<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('frontend_title') | Finact Advisory Training</title>

    <meta name="meta_title" content="{{ siteSetting()->meta_title }}" />
    <meta name="meta_description" content="{{ siteSetting()->meta_description }}" />

    <!-- favicons Icons -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/assets/images/favicons/fav.png') }}" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('frontend_title') | Finact Advisory Training" />
    <meta property="og:description" content="Finact Advisory Training: Trusted expertise in accounting, audit, and financial advisory services, committed to excellence and client success." />
    <meta property="og:image" content="{{ asset('frontend/assets/images/og.jpeg') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="Finact Advisory Training" />

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('frontend_title') | Finact Advisory Training" />
    <meta name="twitter:description" content="Finact Advisory Training: Trusted expertise in accounting, audit, and financial advisory services, committed to excellence and client success." />
    <meta name="twitter:image" content="{{ asset('frontend/assets/images/og.jpeg') }}" />


    <!-- fonts -->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> --}}

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

    {{-- CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- template styles -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}?v={{ time() }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}" />

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}?v={{ time() }}" />

    <style>
        /* Mobile: show_mobile দেখাবে, show_desktop লুকাবে */
        .show_mobile {
            display: flex !important;
        }

        .show_desktop {
            display: none !important;
        }

        /* Desktop (992px+): show_desktop দেখাবে, show_mobile লুকাবে */
        @media (min-width: 992px) {
            .show_desktop {
                display: flex !important;
            }

            .show_mobile {
                display: none !important;
            }
        }
    </style>

</head>

<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <!--Chat Popup-->
    {{-- <div class="chat-icon"><button type="button" class="chat-toggler"><i class="fa fa-comment"></i></button></div>
    @include('frontend.layouts.chat_popup') --}}

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

    {{-- WhatsApp Floating Button --}}
    <a href="https://wa.me/8801325221133" target="_blank" rel="noopener noreferrer" style="
       position: fixed;
       bottom: 80px;
       right: 70px;
       width: 52px;
       height: 52px;
       background: #25D366;
       border-radius: 50%;
       display: flex;
       align-items: center;
       justify-content: center;
       box-shadow: 0 4px 16px rgba(37, 211, 102, 0.45);
       z-index: 9999;
       transition: transform 0.2s ease, box-shadow 0.2s ease;
       text-decoration: none;
   " onmouseover="this.style.transform='scale(1.12)'; this.style.boxShadow='0 6px 22px rgba(37,211,102,0.6)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 16px rgba(37,211,102,0.45)';" title="Chat with us on WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="28" height="28" fill="#ffffff">
            <path d="M16 0C7.164 0 0 7.163 0 16c0 2.824.738 5.476 2.027 7.782L0 32l8.454-2.01A15.938 15.938 0 0016 32c8.836 0 16-7.163 16-16S24.836 0 16 0zm0 29.333a13.27 13.27 0 01-6.77-1.853l-.485-.288-5.02 1.194 1.235-4.888-.316-.502A13.241 13.241 0 012.667 16C2.667 8.636 8.636 2.667 16 2.667S29.333 8.636 29.333 16 23.364 29.333 16 29.333zm7.274-9.874c-.398-.199-2.354-1.161-2.719-1.294-.365-.133-.631-.199-.897.199-.266.398-1.029 1.294-1.261 1.56-.232.266-.465.299-.863.1-.398-.199-1.681-.619-3.202-1.977-1.183-1.056-1.982-2.36-2.214-2.758-.232-.398-.025-.613.174-.811.179-.178.398-.465.597-.698.199-.233.266-.399.398-.665.133-.266.067-.498-.033-.698-.1-.199-.897-2.162-1.229-2.96-.324-.777-.653-.672-.897-.684l-.764-.013c-.266 0-.698.1-1.063.498-.365.398-1.394 1.362-1.394 3.324s1.428 3.854 1.627 4.12c.199.266 2.81 4.291 6.808 6.018.951.41 1.693.655 2.271.839.954.304 1.823.261 2.51.158.766-.114 2.354-.962 2.686-1.89.332-.929.332-1.726.232-1.89-.099-.166-.365-.266-.763-.465z" />
        </svg>
    </a>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- template js -->
    <script src="{{ asset('frontend/assets/js/script.js') }}?v={{ time() }}"></script>
</body>

</html>
