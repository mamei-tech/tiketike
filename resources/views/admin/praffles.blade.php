@extends('admin.layouts.base')

@section('headLinks')
    @parent
@endsection

@section('adminview', 'Roles Manager')

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
                    <h4 class="card-title"> Published raffles </h4>
                </div>

                <div class="card-body">

                    <div class="toolbar">
                        {{--Here you can write extra buttons/actions for the toolbar--}}

                        {{--<button id="btn_addrole" class="btn btn-primary btn-round btn-icon">--}}
                        {{--<i class="now-ui-icons ui-1_simple-add"></i>--}}
                        {{--</button>--}}
                    </div>

                    @include('admin.partials.tables.praffle_table')
                    {{ $raffles->links() }}
                </div>
            </div>
        </div>
    </div>


    {{-- Delete Role Modal --}}
    @include('admin.partials.modals.raffleanulle_modal')

@endsection

@section('footerScripts')
    @parent
    <script src="{{ asset('js/admin/admin_views.js') }}" defer></script>
    <script src="{{ asset('js/admin/praffles.js') }}" defer></script>
@endsection
