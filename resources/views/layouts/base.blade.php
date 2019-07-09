<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@section('header')
    @include('partials.frontend.head')
    @yield('additional_styles')
    @routes
@show

<body>
@include('partials.front_modals.error_notification')
@yield('content')

@section('footer')
    @include('partials.frontend.footer')
@show

@yield('additional_scripts')
</body>

@section('footerScripts')
    <script src="{{ asset('js/generalfrontscript.min.js') }}"></script>
    <script type="text/javascript" defer async>
        $(document).ready(function () {
            @if($errors->any())
            $('#errorModal').modal('show');
            @endif
        });
    </script>
@show

</html>
