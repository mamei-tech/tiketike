<!DOCTYPE html>
<html lang="{{ \App\Facades\Loc::current() }}" dir="{{ \App\Facades\Loc::dir() }}">

<head>

    {{-- Meta, title, CSS, favicons, etc. --}}
    @section('metas')

        {{--TODO benith the favicon sentecen benith--}}
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
        {{--<script src="https://js.pusher.com/4.2/pusher.min.js"></script>--}}

    @show

    <title> {{ config('app.name', 'TikeTike') }} | Admin </title>

    {{--Links--}}
    @section('headLinks')
        @include('admin.partials.links')
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
 
    {{--<script>--}}
        {{--Pusher.logToConsole = true;--}}
    {{--//Remember to replace key and cluster with your credentials.--}}
    {{--var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {--}}
        {{--authEndpoint: 'http://localhost/tiketike/public/pusher/auth',--}}
        {{--auth: {--}}
      {{--headers: {--}}
        {{--'X-CSRF-Token': "{{ csrf_token() }}"--}}
      {{--}--}}
    {{--},--}}
        {{--cluster: 'us2',--}}
        {{--encrypted: true--}}
    {{--});--}}
 {{----}}
    {{--//Also remember to change channel and event name if your's are different.--}}
    {{--var channel = pusher.subscribe('private-App.User.{{ \Auth::user()->id }}');--}}
    {{--channel.bind("Illuminate\\Notifications\\Events\\BroadcastNotificationCreated", function(data) {--}}
        {{--// alert(data);--}}
        {{--var ul = document.getElementById('notifications_component');--}}
        {{--var li = document.createElement('li');--}}
        {{--li.appendChild(document.createTextNode(data['data']));--}}
        {{--ul.appendChild(li);--}}
    {{--});--}}
    {{--channel.bind("subscription_succeeded", function(data) {--}}
        {{--console.log('todo ok');--}}
    {{--});--}}
 {{----}}
    {{--</script>--}}


@section('footerScripts')
    {{--   Core JS Files and + plus  --}}
@show
@routes
</body>
</html>
