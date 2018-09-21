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
                <h5 class="title">@lang('aLogs.overview')</h5>
            </div>

            <div class="card-body">
                <div class="row">

                    @javascript(['chartData' => $chartData])
                    <div class="col-md-6 col-lg-4">
                        <canvas id="stats-doughnut-chart" height="200" class="mb-3"></canvas>
                    </div>

                    <div class="col-md-6 col-lg-8">
                        <div class="row">

                            @foreach($percents as $level => $item)
                                <div class="col-sm-6 col-md-12 col-lg-4 mb-3">
                                    <div class="box level-{{ $level }} {{ $item['count'] === 0 ? 'empty' : '' }}">

                                        {{--Chart--}}
                                        <div class="box-icon">
                                            {!! log_styler()->icon($level) !!}
                                        </div>

                                        {{--Overview--}}
                                        <div class="box-content">
                                            <span class="box-text">{{ $item['name'] }}</span>
                                            <span class="box-number">{{ $item['count'] }} - {!! $item['percent'] !!} %</span>
                                            <div class="progress" style="height: 3px;">
                                                <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-6 col-md-12 col-lg-4 mb-3">
                        <a href="{{ route('log-viewer::logs.list') }}">
                            <button class="btn btn-primary btn-round">
                                <i class="now-ui-icons files_paper"></i> Logs
                            </button>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('footerScripts')
    @parent
    <script src="{{ asset('js/admin/logsdashboard.js') }}" defer></script>
@endsection