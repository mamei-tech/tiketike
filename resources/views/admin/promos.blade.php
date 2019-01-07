@extends('admin.layouts.base')

@section('metas')
    @parent
    {{-- API Acces Tokens --}}
    <meta name="access-token" content="{{Auth::apitoken() }}">
@endsection

@section('headLinks')
    @parent
@endsection

@section('adminview', 'Promo Manager')

@section('pageheader')
    @component('admin.components.pageheader')
        @slot('classSpec')
            panel-header-sm
        @endslot

    @endcomponent
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="title card-title">@lang('aPromo.promo')</h5>
                </div>

                <div class="card-body">

                    <div class="toolbar">
                        {{--Here you can write extra buttons/actions for the toolbar--}}
                        <button id="btn_addpromo" class="btn btn-primary btn-round btn-icon">
                            <i class="now-ui-icons ui-1_simple-add"></i>
                        </button>
                    </div>

                    @include('admin.partials.tables.promo_table')

                </div>
            </div>
        </div>

        {{--Modals--}}
        @include('admin.partials.modals.promodelete_modal')
        @include('admin.partials.modals.promocreate_modal')
        @include('admin.partials.modals.promodetails_modal')
        @include('admin.partials.modals.promoedit_modal')

    </div>

@endsection

@section('footerScripts')
    @parent
    <script src="{{ asset('js/admin/admin_views.js') }}" defer></script>
    <script src="{{ asset('js/admin/promoslist.js') }}" defer></script>
@endsection

