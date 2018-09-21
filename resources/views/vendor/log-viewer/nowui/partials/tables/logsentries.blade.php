<table id="entries" class="table mb-0">
    <thead>
    <tr>
        <th style="width: 95px;">@lang('aLogs.loglevels')</th>
        <th style="width: 50px;">@lang('Time')</th>
        <th>@lang('aLogs.logsheader')</th>
        <th class="text-right"></th>
    </tr>
    </thead>
    <tbody>
    @forelse($entries as $key => $entry)
        <tr>
            <td>
                <span class="badge badge-level-{{ $entry->level }}">
                    {!! $entry->level() !!}
                </span>
            </td>
            <td>
                <span class="">
                    {{ $entry->datetime->format('H:i:s') }}
                </span>
            </td>
            <td>
                {{ $entry->header }}
            </td>
            <td class="text-right">
                {{--<div class="bootstrap-switch-container" style="width: 122px; margin-left: -50px;"><span class="bootstrap-switch-handle-on bootstrap-switch-primary" style="width: 50px;"></span><span class="bootstrap-switch-label" style="width: 30px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-default" style="width: 50px;"></span><input type="checkbox" checked="" name="checkbox" class="bootstrap-switch" data-on-label="" data-off-label=""></div>--}}
                @if ($entry->hasStack())
                    <a class="btn btn-sm btn-light" role="button" data-toggle="collapse" href="#log-stack-{{ $key }}"
                       aria-expanded="false" aria-controls="log-stack-{{ $key }}">
                        <i class="fa fa-toggle-on"></i> Stack
                    </a>
                @endif
            </td>
        </tr>
        @if ($entry->hasStack())
            <tr>
                <td colspan="5" class="stack py-0">
                    <div class="stack-content collapse" id="log-stack-{{ $key }}">
                        {!! $entry->stack() !!}
                    </div>
                </td>
            </tr>
        @endif
    @empty
        <tr>
            <td colspan="5" class="text-center">
                <span class="badge badge-secondary">{{ trans('log-viewer::general.empty-logs') }}</span>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>