<!doctype html>
<html lang="en-US">

<head>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Annual Meeting KMI 2025" />
    <meta name="keywords" content="Annual Meeting" />
    <meta name="author" content="Rosyid Eko Nugroho" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>Annual Meeting KMI 2025</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap&subset=cyrillic"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="css/basic.css"/> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/basic.css') }}" />
    {{-- <link rel="stylesheet" href="css/layout.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}" />
    {{-- <link rel="stylesheet" href="css/magnific-popup.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}" />
    {{-- <link rel="stylesheet" href="css/animate.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />
    {{-- <link rel="stylesheet" href="css/jarallax.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/jarallax.css') }}" />
    {{-- <link rel="stylesheet" href="css/swiper.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/swiper.css') }}" />
    {{-- <link rel="stylesheet" href="css/fontawesome.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}" />
    {{-- <link rel="stylesheet" href="css/brands.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/brands.css') }}" />
    {{-- <link rel="stylesheet" href="css/solid.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/solid.css') }}" />
    <!-- Theme Colors
 <link rel="stylesheet" href="css/theme-colors/blue.css" />
 <link rel="stylesheet" href="css/theme-colors/green.css" />
 <link rel="stylesheet" href="css/theme-colors/orange.css" />
 <link rel="stylesheet" href="css/theme-colors/brown.css" />
 <link rel="stylesheet" href="css/theme-colors/purple.css" />
 <link rel="stylesheet" href="css/theme-colors/red.css" />
 <link rel="stylesheet" href="css/theme-colors/beige.css" />
 <link rel="stylesheet" href="css/theme-colors/green_light.css" />
 <link rel="stylesheet" href="css/theme-colors/yellow.css" />
 <link rel="stylesheet" href="css/theme-colors/yellow_light.css" />
 -->

    <!--[if lt IE 9]>
 <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
 <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
 <![endif]-->

    {{-- <link rel="shortcut icon" href="images/favicons/favicon.ico"> --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/Logo.png') }}">

</head>

<body class="home">

    <!-- Preloader -->
    <div class="preloader">
        <div class="centrize full-width">
            <div class="vertical-center">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Container -->
    <div class="container">

        <!-- Cursor -->
        <div class="cursor-follower"></div>

        <!-- Header -->
        @include('layouts.navbar')
        <!-- Header End -->

        <!-- Wrapper -->
        <div class="wrapper">

            @yield('content')

        </div>

        <!-- Footer -->
        @include('layouts.footer')
        <!-- Footer End -->

        <!-- Lines -->
        <div class="lines">
            <div class="line-col"></div>
            <div class="line-col"></div>
            <div class="line-col"></div>
            <div class="line-col"></div>
            <div class="line-col"></div>
        </div>

    </div>

    <!-- Scripts -->
    {{-- <script src="js/jquery.min.js"></script> --}}
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    {{-- <script src="js/jquery.validate.js"></script> --}}
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    {{-- <script src="js/magnific-popup.js"></script> --}}
    <script src="{{ asset('assets/js/magnific-popup.js') }}"></script>
    {{-- <script src="js/simpleParallax.js"></script> --}}
    <script src="{{ asset('assets/js/simpleParallax.js') }}"></script>
    {{-- <script src="js/typed.js"></script> --}}
    <script src="{{ asset('assets/js/typed.js') }}"></script>
    {{-- <script src="js/jarallax.js"></script> --}}
    <script src="{{ asset('assets/js/jarallax.js') }}"></script>
    {{-- <script src="js/jarallax-video.js"></script> --}}
    <script src="{{ asset('assets/js/jarallax-video.js') }}"></script>
    {{-- <script src="js/jarallax-element.js"></script> --}}
    <script src="{{ asset('assets/js/jarallax-element.js') }}"></script>
    {{-- <script src="js/imagesloaded.pkgd.js"></script> --}}
    <script src="{{ asset('assets/js/imagesloaded.pkgd.js') }}"></script>
    {{-- <script src="js/isotope.pkgd.js"></script> --}}
    <script src="{{ asset('assets/js/isotope.pkgd.js') }}"></script>
    {{-- <script src="js/swiper.js"></script> --}}
    <script src="{{ asset('assets/js/swiper.js') }}"></script>
    {{-- <script src="js/grained.js"></script> --}}
    <script src="{{ asset('assets/js/grained.js') }}"></script>
    {{-- <script src="js/scripts.js"></script> --}}
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

    @include('sweetalert::alert')

</body>

</html>
