<table class="table table-condensed mb-0">
    <tbody>
    <tr>
        <td>@lang('aLogs.filepath'):</td>
        <td colspan="7">{{ $log->getPath() }}</td>
    </tr>
    <tr>
        <td>@lang('aLogs.logentries'):</td>
        <td>
            <span class="badge badge-primary">{{ $entries->total() }}</span>
        </td>
        <td>@lang('aLogs.logsize'):</td>
        <td>
            <span class="badge badge-primary">{{ $log->size() }}</span>
        </td>
        <td>@lang('aLogs.logcreatedat'):</td>
        <td>
            <span class="badge badge-primary">{{ $log->createdAt() }}</span>
        </td>
        <td>@lang('aLogs.logupdatedat'):</td>
        <td>
            <span class="badge badge-primary">{{ $log->updatedAt() }}</span>
        </td>
    </tr>
    </tbody>
</table>