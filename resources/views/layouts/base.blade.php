<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@section('header')
    @include('partials.frontend.head')
@show

<body>
@yield('content')

@section('footer')
    @include('partials.frontend.footer')
@show
@yield('additional_scripts')
</body>

</html>