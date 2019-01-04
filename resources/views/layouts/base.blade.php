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

@section('footerScripts')
    <script src="{{ asset('js/generalfrontscript.min.js') }}"></script>
@show

</html>