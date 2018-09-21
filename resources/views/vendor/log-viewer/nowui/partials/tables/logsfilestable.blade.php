<table class="table table-sm table-hover">

    <thead class="text-primary">
    <tr>
        @foreach($headers as $key => $header)
            <th scope="col" class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                @if ($key !== 'date')
                    <span class="badge badge-level-{{ $key }}">
                        {!! log_styler()->icon($key)!!}
                    </span>
                @endif
            </th>
        @endforeach
        <th scope="col" class="text-right">@lang('Actions')</th>
    </tr>
    </thead>

    <tbody>
    @if ($rows->count() > 0)
        @foreach($rows as $date => $row)
            <tr>
                @foreach($row as $key => $value)
                    <td class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                        @if ($key == 'date')
                            <span class="badge badge-primary">{{ $value }}</span>
                        @elseif ($value == 0)
                            <span class="badge empty">{{ $value }}</span>
                        @else
                            <a href="{{ route('log-viewer::logs.filter', [$date, $key]) }}">
                                <span class="badge badge-level-{{ $key }}">{{ $value }}</span>
                            </a>
                        @endif
                    </td>
                @endforeach

                <td class="text-right">
                    <a href="{{ route('log-viewer::logs.show', [$date]) }}"
                       class="btn btn-info btn-icon btn-sm">
                        <i class="now-ui-icons ui-1_zoom-bold"></i>
                    </a>
                    <a href="{{ route('log-viewer::logs.download', [$date]) }}"
                       class="btn btn-success btn-icon btn-sm">
                        <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                    </a>
                    <a href="#delete-log-modal" class="btn btn-danger btn-icon btn-sm"
                       data-log-date="{{ $date }}">
                        <i class="now-ui-icons ui-1_simple-remove"></i>
                    </a>
                </td>

            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="11" class="text-center">
                <span class="badge badge-secondary">{{ trans('log-viewer::general.empty-logs') }}</span>
            </td>
        </tr>
    @endif
    </tbody>
</table>