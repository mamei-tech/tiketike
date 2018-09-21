<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <title> {{ config('app.name', 'TikeTike') }} | @yield('title', 'Home') </title>
</head>

<body>

    @include('partials.nav')

    @include('partials.message')

<div class="container">
    @yield('content')
</div>

</body>

@section('footerScripts')
    <script src="#"></script>
@show

</html>