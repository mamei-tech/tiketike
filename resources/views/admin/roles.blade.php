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
                    <h4 class="card-title"> Roles List </h4>
                </div>

                <div class="card-body">

                    <div class="toolbar">
                        {{--Here you can write extra buttons/actions for the toolbar--}}
                        <button id="btn_addrole" class="btn btn-primary btn-round btn-icon">
                            <i class="now-ui-icons ui-1_simple-add"></i>
                        </button>
                    </div>

                    {{-- Role List Table --}}
                    @include('admin.partials.tables.roles_table')
                    {{ $roles->links() }}
                </div>
            </div>
        </div>

        {{-- Create Role Modal --}}
        @include('admin.partials.modals.rolescreate_modal')

        {{-- Delete Role Modal --}}
        @include('admin.partials.modals.rolesdelete_modal')

        {{-- Edit Role Modal --}}
        @include('admin.partials.modals.rolesupdate_modal')

    </div>

@endsection

@section('footerScripts')
    @parent
    <script src="{{ asset('js/admin/admin_views.js') }}" defer></script>
    <script src="{{ asset('js/admin/roles.js') }}" defer></script>
@endsection
