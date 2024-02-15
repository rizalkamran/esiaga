<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Siaga Mobile</title>

    <!--fivicon icon-->
    <link href="{{ asset('image/mobile/favicon-esiaga.png') }}" rel="icon" type="image/png">

    <!-- Stylesheet -->
    <link href="{{ asset('css/mobile/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mobile/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mobile/magnific.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mobile/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mobile/nice-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mobile/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mobile/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mobile/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mobile/responsive.css') }}" rel="stylesheet">

    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">


</head>

<body class="@yield('body_class')">
    @yield('content')



    <!-- all plugins here -->
    <script src="{{ asset('js/mobile/jquery.3.6.min.js') }}"></script>
    <script src="{{ asset('js/mobile/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/mobile/imageloded.min.js') }}"></script>
    <script src="{{ asset('js/mobile/counterup.js') }}"></script>
    <script src="{{ asset('js/mobile/waypoint.js') }}"></script>
    <script src="{{ asset('js/mobile/magnific.min.js') }}"></script>
    <script src="{{ asset('js/mobile/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/mobile/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/mobile/nice-select.min.js') }}"></script>
    <script src="{{ asset('js/mobile/fontawesome.min.js') }}"></script>
    <script src="{{ asset('js/mobile/owl.min.js') }}"></script>
    <script src="{{ asset('js/mobile/slick-slider.min.js') }}"></script>
    <script src="{{ asset('js/mobile/wow.min.js') }}"></script>
    <script src="{{ asset('js/mobile/tweenmax.min.js') }}"></script>

    <!-- main js  -->
    <script src="{{ asset('js/mobile/main.js') }}"></script>
</body>

</html>
