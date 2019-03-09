@extends('admin.layouts.base')

@section('metas')
    @parent
    {{-- API Acces Tokens --}}
    <meta name="access-token" content="{{Auth::apitoken() }}">
@endsection

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
                    <h4 class="card-title"> Comments </h4>
                </div>

                <div class="card-body">

                    <div class="toolbar">
                        {{--Here you can write extra buttons/actions for the toolbar--}}
                        <button id="btn_addraffle" class="btn btn-primary btn-round btn-icon">
                        <i class="now-ui-icons ui-1_simple-add"></i>
                        </button>
                    </div>


                    @include('admin.partials.tables.comments_table')

                    {{ $comments->links() }}
                </div>
            </div>
        </div>

        {{--Create Role Modal --}}
        {{--@include('admin.partials.modals.rafflepublish_modal')--}}
        {{--@include('admin.partials.modals.araffledelete_modal')--}}
        {{--@include('admin.partials.modals.urafflecreate_modal')--}}
        {{--@include('admin.partials.modals.uraffleedit_modal')--}}

    </div>

@endsection

@section('footerScripts')
    @parent
    <script src="{{ asset('js/admin/admin_views.js') }}" defer></script>
    <script src="{{ asset('js/admin/uraffles.js') }}" defer></script>
@endsection
