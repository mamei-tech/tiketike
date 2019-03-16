@extends('admin.layouts.base')

@section('adminview', __('aUserprofile.sectiontitle') )

@section('pageheader')
    @component('admin.components.pageheader')
        @slot('classSpec')
            panel-header-sm
        @endslot

    @endcomponent
@endsection

@section('content')

    <div class="row">

        {{-- USER FORM --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="title"> Billing Information </h4>
                </div>

                <div id="div_formContainer" class="card-body">
                    @include('admin.partials.forms.userbilling_form')
                </div>

            </div>
        </div>

    </div>


@endsection

@section('footerScripts')
    @parent
    <script src="{{ asset('js/admin/admin_views.js') }}" defer></script>
    <script src="{{ asset('js/admin/userbilling.js') }}" defer></script>
@endsection

