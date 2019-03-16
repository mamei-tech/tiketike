<!DOCTYPE html>
<html lang="{{ \App\Facades\Loc::current() }}" dir="{{ \App\Facades\Loc::dir() }}">

<head>

    {{-- Meta, title, CSS, favicons, etc. --}}
    @section('metas')
        {{-- <link rel="icon" type="image/png" href="../assets/img/favicon.png"> --}}

        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <meta name="description" content="TikeTike Raffles System">
        <meta name="author" content="ARCANEDEV">
        <meta name="mod by" content="Mamei">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
              name='viewport'/>
    @show

    <title> {{ config('app.name', 'TikeTike') }} | Admin </title>

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

{{--Links--}}
@section('headLinks')
    @include('vendor.log-viewer.nowui.partials.links')
@show

<body class="sidebar-mini">
<div class="wrapper">
    @include('admin.partials.sidebar')
    {{--Main panel --}}
    <div class="main-panel">

        {{-- Navbar --}}
        @include('admin.partials.navbar')
        {{-- End Navbar --}}

        @yield('pageheader')

        <div class="content">
            @include('admin.partials.message')

            @yield('content')
        </div>

        @include('admin.partials.footer')
    </div>
</div>

    @yield('modals')

</body>


@section('footerScripts')
    {{--   Core JS Files and + plus  --}}
    <script src="{{ asset('js/admin/admin_logsviewer.js') }}" defer></script>
@show

</html>
