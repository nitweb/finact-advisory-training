<!DOCTYPE html>

<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->


<head>

    <!-- Basic Page Needs -->

    <meta charset="utf-8">

    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <title>@yield('frontend_title') | Rahman Anis & Co - CA</title>

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Bootstrap  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/stylesheets/bootstrap.css') }}">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/stylesheets/style.css') }}">

    <!-- Colors -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/stylesheets/colors/color1.css') }}" id="colors">

    <!-- REVOLUTION LAYERS STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/revolution/css/settings.css') }}">

    <!-- Responsive -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/stylesheets/responsive.css') }}">

    <!-- Animation Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/stylesheets/animate.css') }}">

    <!-- Favicon and touch icons  -->
    <link href="{{ asset('/frontend/images/favicon.jpg') }}" rel="shortcut icon">

    <!--[if lt IE 9]>
        <script src="javascript/html5shiv.js"></script>
        <script src="javascript/respond.min.js"></script>
    <![endif]-->

    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- AOS CDN --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Flipbook StyleSheet -->
    <link href="{{ asset('frontend/dflip/css/dflip.min.css') }} " rel="stylesheet" type="text/css">

    <!-- Icons Stylesheet -->
    <link href="{{ asset('frontend/dflip/css/themify-icons.min.css') }}" rel="stylesheet" type="text/css">

</head>

<body class="header-sticky">

    {{-- ############### PRELOADER SECTION ############### --}}
    @include('frontend.body.preloader')

    <div class="boxed">

        {{-- ############### HEADER SECTION ############### --}}
        @include('frontend.body.header')

        {{-- ############### INDEX SECTION ############### --}}
        @yield('frontend_content')

        {{-- ############### FOOTER SECTION ############### --}}
        @include('frontend.body.footer')


        <!-- Go Top -->
        <a class="go-top">
            <i class="fa fa-angle-up"></i>
        </a>

    </div>

    <!-- Javascript -->
    <script type="text/javascript" src="{{ asset('/frontend/javascript/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/javascript/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/javascript/jquery.easing.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/javascript/imagesloaded.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/javascript/jquery.isotope.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/frontend/javascript/jquery-countTo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/javascript/jquery-waypoints.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/frontend/javascript/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/javascript/jquery.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/javascript/jquery.fitvids.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/javascript/parallax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/javascript/smoothscroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/javascript/jquery.flexslider-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/javascript/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/javascript/jquery-validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/javascript/jquery.mb.YTPlayer.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/frontend/javascript/main.js') }}"></script>

    <!-- Revolution Slider -->
    <script type="text/javascript" src="{{ asset('/frontend/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/revolution/js/slider3.js') }}"></script>

    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
    <script type="text/javascript" src="{{ asset('/frontend/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/frontend/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- AOS CDN --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init();
    </script>

    <!-- Flipbook main Js file -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> --}}
    <script src="{{ asset('frontend/dflip/js/dflip.min.js') }}" type="text/javascript"></script>

</body>

</html>
