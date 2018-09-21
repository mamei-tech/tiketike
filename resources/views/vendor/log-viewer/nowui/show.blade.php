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
                <h5 class="title">Log {{ $log->date }}</h5>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    {{-- Log Menu --}}
                    @include('vendor.log-viewer.nowui.components.logscatnavigation')
                </div>

                <div class="col-lg-10">

                    {{-- Log Details --}}
                    @include('vendor.log-viewer.nowui.partials.logsfileditail')

                    {{-- Log Entries --}}
                    <div class="card mb-4">
                        @if ($entries->hasPages())
                            <div class="card-header">
                        <span class="badge badge-info float-right">
                            Page {!! $entries->currentPage() !!} of {!! $entries->lastPage() !!}
                        </span>
                            </div>
                        @endif

                        <div class="table-responsive">
                            @include('vendor.log-viewer.nowui.partials.tables.logsentries')
                        </div>
                    </div>

                    {!! $entries->appends(compact('query'))->render() !!}
                </div>
            </div>

        </div>
    </div>
@endsection

@section('modals')
    {{-- DELETE MODAL --}}
    <div id="delete-log-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="delete-log-form" action="{{ route('log-viewer::logs.delete') }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="date" value="{{ $log->date }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">DELETE LOG FILE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to <span class="badge badge-danger">DELETE</span> this log file <span class="badge badge-primary">{{ $log->date }}</span> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary mr-auto" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">DELETE FILE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footerScripts')
    @parent
    <script src="{{ asset('js/admin/logsshow.js') }}" defer></script>
    <script>
        @unless (empty(log_styler()->toHighlight()))
        $('.stack-content').each(function () {
            var $this = $(this);
            var html = $this.html().trim()
                .replace(/({!! join(log_styler()->toHighlight(), '|') !!})/gm, '<strong>$1</strong>');

            $this.html(html);
        });
        @endunless
    </script>
@endsection
