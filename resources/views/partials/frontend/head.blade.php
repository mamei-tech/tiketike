<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('pics/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/front/app.css') }}">

    <script src="{{ asset('js/front/plugins/fileUploader/html5shiv.min.js') }}"></script>
    <script src="{{ asset('js/front/plugins/fileUploader/respond.min.js') }}"></script>

    <link type="text/css" rel="stylesheet" href="{{ asset('js/front/plugins/fancybox/source/jquery.fancybox.css?v=2.1.2') }}">
    <link href="{{ asset('js/front/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('js/front/plugins/carousel-owl-carousel/owl-carousel/owl.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('js/front/plugins/slider-revolution-slider/rs-plugin/css/settings.css') }}" rel="stylesheet">
    <link href="{{ asset('js/front/plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front/uploader/style.min.css') }}" rel="stylesheet">
    <title> {{ config('app.name', 'TikeTike') }} | @yield('title', @lang('views.home')) </title>
</head>
