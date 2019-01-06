<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title> {{ config('app.name', 'TikeTike') }} | @yield('title', 'Login') </title>
    {{-- <link rel="icon" type="image/png" href="../assets/img/favicon.png"> --}}

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="description" content="TikeTike Raffles System">
    <meta name="author" content="Mamei">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>

    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.partials.links')
    {{--<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />--}}
    <link href="{{ asset('css/vendor/vendor.css') }}" rel="stylesheet">
    {{-- CSS Files --}}
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">
</head>
<body>
    @yield('content')
    <script src="{{ asset('js/admin/admin_views.js') }}" defer></script>
    <script src="{{ asset('js/login.js') }}" defer></script>
</body>
</html>