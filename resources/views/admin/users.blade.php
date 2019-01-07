@extends('admin.layouts.base')

@section('metas')
    @parent
    {{-- API Acces Tokens --}}
    <meta name="access-token" content="{{Auth::apitoken() }}">
@endsection

@section('headLinks')
    @parent
@endsection

@section('adminview', 'User Manager')

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
                    <h4 class="card-title">@lang('aUserprofile.userlist')</h4>
                </div>

                <div class="card-body">

                    <div class="toolbar">
                        {{--Here you can write extra buttons/actions for the toolbar--}}
                    </div>

                    @include('admin.partials.tables.user_table')
                    {{ $users->links() }}
                </div>
            </div>
        </div>

    </div>

    {{--Create Role Modal --}}
    @include('admin.partials.modals.userupdate_modal')
    @include('admin.partials.modals.userdelete_modal')

@endsection

@section('footerScripts')
    @parent
    <script src="{{ asset('js/admin/admin_views.js') }}" defer></script>
    <script src="{{ asset('js/admin/users.js') }}" defer></script>
@endsection

