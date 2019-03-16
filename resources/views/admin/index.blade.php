@extends('admin.layouts.base')

@section('pageheader')
    @component('admin.components.pageheader')
        @slot('classSpec')
            panel-header-lg
        @endslot
        <canvas id="bigDashboardChart"></canvas>
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-stats card-raised">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="statistics">
                                <div class="info">
                                    <div class="icon icon-primary">
                                        <i class="now-ui-icons ui-2_chat-round"></i>
                                    </div>
                                    <h3 class="info-title">859</h3>
                                    <h6 class="stats-title">Messages</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="statistics">
                                <div class="info">
                                    <div class="icon icon-success">
                                        <i class="now-ui-icons business_money-coins"></i>
                                    </div>
                                    <h3 class="info-title">
                                        <small>$</small>
                                        {{$netGain}}
                                    </h3>
                                    <h6 class="stats-title">Net. Gain</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="statistics">
                                <div class="info">
                                    <div class="icon icon-info">
                                        <i class="now-ui-icons users_single-02"></i>
                                    </div>
                                    <h3 class="info-title">{{$usersCount}}</h3>
                                    <h6 class="stats-title">Users</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="statistics">
                                <div class="info">
                                    <div class="icon icon-danger">
                                        <i class="now-ui-icons objects_support-17"></i>
                                    </div>
                                    <h3 class="info-title">353</h3>
                                    <h6 class="stats-title">Support Requests</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="card-body">--}}
        {{--<div class="chart-area">--}}
            {{--<canvas id="activeUsers"></canvas>--}}
            {{--<div class="stats">--}}
                {{--<i id="refreshActUsers" class="now-ui-icons arrows-1_refresh-69"></i>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="row">
        <div class="card-body data-section-midle-row data-section-full-row">
            <div class="chart-area">
                <canvas id="activeUsers" class="bar-chart-canvas"></canvas>
                {{--<div class="stats">--}}
                    {{--<i id="refreshActUsers" class="now-ui-icons arrows-1_refresh-69"></i>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card data-section-midle-row">
            <div class="chart-area">
                <canvas id="usersData"></canvas>
            </div>
        </div>
        <div class="card data-section-midle-row">
            <div class="chart-area">
                <canvas id="rafflesData"></canvas>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card data-section-midle-row">
            <div class="chart-area">
                <canvas id="ticketsData" class="bar-chart-canvas"></canvas>
            </div>
        </div>
        <div class="card data-section-midle-row">
            <div class="chart-area">
                <canvas id="ticketsBySocialNetworksData" class="bar-chart-canvas"></canvas>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card data-section-midle-row">
            <div class="chart-area">
                <canvas id="moneyByTickets"></canvas>
            </div>
        </div>
        <div class="card data-section-midle-row">
            <div class="chart-area">
                <canvas id="xxx"></canvas>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card data-section-midle-row data-section-full-row text-center">
            <h4>Shared Raffles</h4>
            @include('admin.partials.tables.groups_table')
        </div>
    </div>

    {{--<div class="row">--}}
        {{--<div class="card data-section-midle-row data-section-full-row">--}}
            {{--<h3>Tickets Data</h3>--}}
            {{--@include('admin.partials.tables.dash_tickets_table')--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="row">--}}
        {{--<div class="card data-section-midle-row data-section-full-row">--}}
            {{--<h3>Money Data</h3>--}}
            {{--@include('admin.partials.tables.dash_money_table')--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="row">--}}
        {{--<div class="col-lg-4 col-md-6">--}}
            {{--<div class="card card-chart">--}}
                {{--<div class="card-header">--}}

                    {{--<h2>Users Data</h2>--}}

                    {{--@include('admin.partials.tables.dash_users_table')--}}

                    {{--<div class="dropdown">--}}
                        {{--<button type="button"--}}
                                {{--class="btn btn-round btn-default dropdown-toggle btn-simple btn-icon no-caret"--}}
                                {{--data-toggle="dropdown">--}}
                            {{--<i class="now-ui-icons loader_gear"></i>--}}
                        {{--</button>--}}
                        {{--<div class="dropdown-menu dropdown-menu-right">--}}
                            {{--<a class="dropdown-item" href="#">Action</a>--}}
                            {{--<a class="dropdown-item" href="#">Another action</a>--}}
                            {{--<a class="dropdown-item" href="#">Something else here</a>--}}
                            {{--<a class="dropdown-item text-danger" href="#">Remove Data</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="card-body">--}}
                    {{--<div class="chart-area">--}}
                        {{--<canvas id="activeUsers" data-background-color="red"></canvas>--}}
                    {{--</div>--}}
                    {{--<div class="table-responsive">--}}
                        {{--<table class="table">--}}
                            {{--<tbody>--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--<div class="flag">--}}
                                        {{--<img src="../assets/img/US.png">--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td>USA</td>--}}
                                {{--<td class="text-right">--}}
                                    {{--2.920--}}
                                {{--</td>--}}
                                {{--<td class="text-right">--}}
                                    {{--53.23%--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--<div class="flag">--}}
                                        {{--<img src="../assets/img/DE.png">--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td>Germany</td>--}}
                                {{--<td class="text-right">--}}
                                    {{--1.300--}}
                                {{--</td>--}}
                                {{--<td class="text-right">--}}
                                    {{--20.43%--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--<div class="flag">--}}
                                        {{--<img src="../assets/img/AU.png">--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td>Australia</td>--}}
                                {{--<td class="text-right">--}}
                                    {{--760--}}
                                {{--</td>--}}
                                {{--<td class="text-right">--}}
                                    {{--10.35%--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--<div class="flag">--}}
                                        {{--<img src="../assets/img/GB.png">--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td>United Kingdom</td>--}}
                                {{--<td class="text-right">--}}
                                    {{--690--}}
                                {{--</td>--}}
                                {{--<td class="text-right">--}}
                                    {{--7.87%--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--<div class="flag">--}}
                                        {{--<img src="../assets/img/RO.png">--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td>Romania</td>--}}
                                {{--<td class="text-right">--}}
                                    {{--600--}}
                                {{--</td>--}}
                                {{--<td class="text-right">--}}
                                    {{--5.94%--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--<div class="flag">--}}
                                        {{--<img src="../assets/img/BR.png">--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td>Brasil</td>--}}
                                {{--<td class="text-right">--}}
                                    {{--550--}}
                                {{--</td>--}}
                                {{--<td class="text-right">--}}
                                    {{--4.34%--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="card-footer">--}}
                    {{--<div class="stats">--}}
                        {{--<i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-4 col-md-6">--}}
            {{--<div class="card card-chart">--}}
                {{--<div class="card-header">--}}
                    {{--<h2>Raffles Data</h2>--}}

                    {{--@include('admin.partials.tables.dash_raffles_table')--}}
                    {{--<div class="dropdown">--}}
                        {{--<button type="button"--}}
                                {{--class="btn btn-round btn-default dropdown-toggle btn-simple btn-icon no-caret"--}}
                                {{--data-toggle="dropdown">--}}
                            {{--<i class="now-ui-icons loader_gear"></i>--}}
                        {{--</button>--}}
                        {{--<div class="dropdown-menu dropdown-menu-right">--}}
                            {{--<a class="dropdown-item" href="#">Action</a>--}}
                            {{--<a class="dropdown-item" href="#">Another action</a>--}}
                            {{--<a class="dropdown-item" href="#">Something else here</a>--}}
                            {{--<a class="dropdown-item text-danger" href="#">Remove Data</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="card-body">--}}
                    {{--<div class="chart-area">--}}
                        {{--<canvas id="emailsCampaignChart"></canvas>--}}
                    {{--</div>--}}
                    {{--<div class="card-progress">--}}
                        {{--<div class="progress-container">--}}
                            {{--<span class="progress-badge">Delivery Rate</span>--}}
                            {{--<div class="progress">--}}
                                {{--<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"--}}
                                     {{--aria-valuemax="100" style="width: 90%;">--}}
                                    {{--<span class="progress-value">90%</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="progress-container progress-success">--}}
                            {{--<span class="progress-badge">Open Rate</span>--}}
                            {{--<div class="progress">--}}
                                {{--<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60"--}}
                                     {{--aria-valuemin="0" aria-valuemax="100" style="width: 60%;">--}}
                                    {{--<span class="progress-value">60%</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="progress-container progress-info">--}}
                            {{--<span class="progress-badge">Click Rate</span>--}}
                            {{--<div class="progress">--}}
                                {{--<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60"--}}
                                     {{--aria-valuemin="0" aria-valuemax="100" style="width: 12%;">--}}
                                    {{--<span class="progress-value">12%</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="progress-container progress-warning">--}}
                            {{--<span class="progress-badge">Hard Bounce</span>--}}
                            {{--<div class="progress">--}}
                                {{--<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60"--}}
                                     {{--aria-valuemin="0" aria-valuemax="100" style="width: 5%;">--}}
                                    {{--<span class="progress-value">5%</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="progress-container progress-danger">--}}
                            {{--<span class="progress-badge">Spam Report</span>--}}
                            {{--<div class="progress">--}}
                                {{--<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60"--}}
                                     {{--aria-valuemin="0" aria-valuemax="100" style="width: 0.11%;">--}}
                                    {{--<span class="progress-value">0.11%</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="card-footer">--}}
                    {{--<div class="stats">--}}
                        {{--<i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-4 col-md-6">--}}
            {{--<div class="card card-chart">--}}
                {{--<div class="card-header">--}}
                    {{--<h2>Tickets Data</h2>--}}
                    {{--<h5 class="card-category">Solded</h5>--}}
                    {{--<h2 class="card-title">{{$soldedTicketsCount}}</h2>--}}
                    {{--<h5 class="card-category">By Commission</h5>--}}
                    {{--<h2 class="card-title">{{$soldedTicketsCountByCom}}</h2>--}}
                    {{--<h5 class="card-category">Male</h5>--}}
                    {{--<h2 class="card-title">{{$comMaleSolds}}</h2>--}}
                    {{--<h5 class="card-category">Female</h5>--}}
                    {{--<h2 class="card-title">{{$comFemaleSolds}}</h2>--}}
                    {{--<h5 class="card-category">Directly</h5>--}}
                    {{--<h2 class="card-title">{{$soldedTicketsCountDirec}}</h2>--}}
                    {{--<h5 class="card-category">Male</h5>--}}
                    {{--<h2 class="card-title">{{$directMaleSolds}}</h2>--}}
                    {{--<h5 class="card-category">Female</h5>--}}
                    {{--<h2 class="card-title">{{$directFemaleSolds}}</h2>--}}
                    {{--<h5 class="card-category">Remain</h5>--}}
                    {{--<h2 class="card-title">{{$remainTickets}}</h2>--}}
                {{--</div>--}}
                {{--<div class="card-body">--}}
                    {{--<div class="chart-area">--}}
                        {{--<canvas id="activeCountries"></canvas>--}}
                    {{--</div>--}}
                    {{--<div id="worldMap" class="map"></div>--}}
                {{--</div>--}}
                {{--<div class="card-footer">--}}
                    {{--<div class="stats">--}}
                        {{--<i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="card-footer">--}}
                    {{--<div class="stats">--}}
                        {{--<i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-4 col-md-6">--}}
            {{--<div class="card card-chart">--}}
                {{--<div class="card-header">--}}
                    {{--<h2>Money Data</h2>--}}
                    {{--<h5 class="card-category">By tickets</h5>--}}
                    {{--<h2 class="card-title">{{$moneyCountByTickets}}</h2>--}}
                    {{--<h5 class="card-category">Directly</h5>--}}
                    {{--<h2 class="card-title">{{$directlyMoneyCount}}</h2>--}}
                    {{--<h5 class="card-category">Commisions</h5>--}}
                    {{--<h2 class="card-title">{{$comMoneyCount}}</h2>--}}
                {{--</div>--}}
                {{--<div class="card-footer">--}}
                    {{--<div class="stats">--}}
                        {{--<i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">--}}
                    {{--<h4 class="card-title"> Best Selling Products</h4>--}}
                {{--</div>--}}
                {{--<div class="card-body">--}}
                    {{--<div class="table-responsive">--}}
                        {{--<table class="table table-shopping">--}}
                            {{--<thead class="">--}}
                            {{--<th class="text-center">--}}
                            {{--</th>--}}
                            {{--<th>--}}
                                {{--Product--}}
                            {{--</th>--}}
                            {{--<th>--}}
                                {{--Color--}}
                            {{--</th>--}}
                            {{--<th>--}}
                                {{--Size--}}
                            {{--</th>--}}
                            {{--<th class="text-right">--}}
                                {{--Price--}}
                            {{--</th>--}}
                            {{--<th class="text-right">--}}
                                {{--Qty--}}
                            {{--</th>--}}
                            {{--<th class="text-right">--}}
                                {{--Amount--}}
                            {{--</th>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--<div class="img-container">--}}
                                        {{--<img src="../assets/img/saint-laurent.jpg" alt="...">--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td class="td-name">--}}
                                    {{--<a href="#jacket">Suede Biker Jacket</a>--}}
                                    {{--<br/>--}}
                                    {{--<small>by Saint Laurent</small>--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--Black--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--M--}}
                                {{--</td>--}}
                                {{--<td class="td-number">--}}
                                    {{--<small>€</small>--}}
                                    {{--3,390--}}
                                {{--</td>--}}
                                {{--<td class="td-number">--}}
                                    {{--1--}}
                                {{--</td>--}}
                                {{--<td class="td-number">--}}
                                    {{--<small>€</small>--}}
                                    {{--549--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--<div class="img-container">--}}
                                        {{--<img src="../assets/img/balmain.jpg" alt="...">--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td class="td-name">--}}
                                    {{--<a href="#pants">Jersey T-Shirt</a>--}}
                                    {{--<br/>--}}
                                    {{--<small>by Balmain</small>--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--Black--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--M--}}
                                {{--</td>--}}
                                {{--<td class="td-number">--}}
                                    {{--<small>€</small>--}}
                                    {{--499--}}
                                {{--</td>--}}
                                {{--<td class="td-number">--}}
                                    {{--2--}}
                                {{--</td>--}}
                                {{--<td class="td-number">--}}
                                    {{--<small>€</small>--}}
                                    {{--998--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--<div class="img-container">--}}
                                        {{--<img src="../assets/img/prada.jpg" alt="...">--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td class="td-name">--}}
                                    {{--<a href="#nothing">Slim-Fit Swim Short</a>--}}
                                    {{--<br/>--}}
                                    {{--<small>by Prada</small>--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--Red--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--M--}}
                                {{--</td>--}}
                                {{--<td class="td-number">--}}
                                    {{--<small>€</small>--}}
                                    {{--200--}}
                                {{--</td>--}}
                                {{--<td class="td-number">--}}
                                    {{--1--}}
                                {{--</td>--}}
                                {{--<td class="td-number">--}}
                                    {{--<small>€</small>--}}
                                    {{--799--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td colspan="5">--}}
                                {{--</td>--}}
                                {{--<td class="td-total">--}}
                                    {{--Total--}}
                                {{--</td>--}}
                                {{--<td class="td-price">--}}
                                    {{--<small>€</small>--}}
                                    {{--2,346--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    @include('admin.partials.modals.rafflereferrals_modal')
@endsection

@section('footerScripts')
    @parent
    <script src="{{ asset('js/admin/admin_dash.js') }}" defer></script>
    <link href="{{ asset('css/front/admin_dash.css')}}" rel="stylesheet">
@endsection

