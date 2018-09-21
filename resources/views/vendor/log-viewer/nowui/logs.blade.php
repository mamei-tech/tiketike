@extends('log-viewer::nowui._master')

@section('adminview', __('aLogs.sectiontitle'))

@section('pageheader')
    @component('admin.components.pageheader')
        @slot('classSpec')
            panel-header-sm
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h5 class="title">Logs</h5>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card-body able-full-width">

                        <div class="table-responsive">
                            @include('vendor.log-viewer.nowui.partials.tables.logsfilestable')
                        </div>

                        {!! $rows->render() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('modals')
    @include('vendor.log-viewer.nowui.partials.modals.deletelogs')
@endsection

@section('footerScripts')
    @parent
    <script src="{{ asset('js/admin/logsview.js') }}" defer></script>
@endsection
