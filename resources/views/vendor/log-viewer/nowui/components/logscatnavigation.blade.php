
<div class="card mb-4">
    <div class="card-header"><i class="now-ui-icons business_globe"></i>&emsp;@lang('aLogs.loglevels')</div>
    <div class="list-group list-group-flush log-menu">
        @foreach($log->menu() as $levelKey => $item)
            @if ($item['count'] === 0)
                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                    <span class="level-name">{!! $item['icon'] !!} {{ $item['name'] }}</span>
                    <span class="badge empty">{{ $item['count'] }}</span>
                </a>
            @else
                <a href="{{ $item['url'] }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center level-{{ $levelKey }}{{ $level === $levelKey ? ' active' : ''}}">
                    <span class="level-name">{!! $item['icon'] !!} {{ $item['name'] }}</span>
                    <span class="badge badge-level-{{ $levelKey }}">{{ $item['count'] }}</span>
                </a>
            @endif
        @endforeach
    </div>
</div>