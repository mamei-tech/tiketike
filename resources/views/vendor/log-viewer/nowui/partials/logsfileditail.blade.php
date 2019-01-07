
<div class="card mb-4">

    <div class="card-header">
        <div class="group-btns pull-right">
            <a href="{{ route('log-viewer::logs.download', [$log->date]) }}" class="btn btn-sm btn-round btn-success">
                <i class="now-ui-icons arrows-1_cloud-download-93"></i> @lang('Download')
            </a>
            <a href="#delete-log-modal" class="btn btn-sm btn-round btn-danger" data-toggle="modal">
                <i class="now-ui-icons ui-1_simple-remove"></i> @lang('Delete')
            </a>
        </div>
    </div>

    <div class="table-responsive">
        @include('vendor.log-viewer.nowui.partials.tables.logdetailtable')
    </div>

    <div class="card-footer">

        {{-- Search --}}
        <form action="{{ route('log-viewer::logs.search', [$log->date, $level]) }}" method="GET">
            <div class=form-group">
                <div class="input-group">
                    <input id="query" name="query" class="form-control"  value="{!! request('query') !!}" placeholder="{{ __('Type here to search') }}">
                    <div class="input-group-append">
                        @if (request()->has('query'))
                            <a href="{{ route('log-viewer::logs.show', [$log->date]) }}" class="btn btn-secondary">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                            </a>
                        @endif
                        <button id="search-btn" class=  "btn btn-primary">
                            <span class="now-ui-icons ui-1_zoom-bold"></span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>

</div>