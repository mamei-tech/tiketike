{{--@extends('admin.layouts.base')--}}

{{--@section('adminview', __('aUserprofile.sectiontitle') )--}}

{{--@section('pageheader')--}}
    {{--@component('admin.components.pageheader')--}}
        {{--@slot('classSpec')--}}
            {{--panel-header-sm--}}
        {{--@endslot--}}

    {{--@endcomponent--}}
{{--@endsection--}}

{{--@section('content')--}}

    {{--<div class="row">--}}

        {{-- USER FORM --}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}

                {{-- TODO Apply this style tittle to the other views --}}
                {{--<div class="card-header">--}}
                    {{--<h5 class="title"> User </h5>--}}
                {{--</div>--}}

                {{--<div id="div_formContainer" class="card-body">--}}
                    {{--@include('admin.partials.forms.userprofile_form')--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}

        {{-- USER CARD --}}
        {{--<div class="col-md-4">--}}
            {{--<div class="card-container">--}}
                {{--<div class="rotating-card">--}}

                    {{-- FRONT --}}
                    {{--@include('admin.partials.cards.usercard-front')--}}

                    {{-- BACK --}}
                    {{--@include('admin.partials.cards.usercard-back')--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


{{--@endsection--}}

{{--@section('footerScripts')--}}
    {{--@parent--}}
    {{--<script src="{{ asset('js/admin/admin_views.js') }}" defer></script>--}}
    {{--<script src="{{ asset('js/admin/userprofile.js') }}" defer></script>--}}
{{--@endsection--}}

