@extends('layouts.base')
@section('content')
    @include('partials.frontend.header')
    @include('partials.front_modals.mobile_suggest')
    @include('partials.front_modals.notification_modal')
    <div class="container margin-top60">
        <div class="row">
            <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 padding-rigth-0">
                <div class="bg-grisU paddingLateralGris">
                    <div class="row padding-top-30">


                        <div class="col-xs-5 col-md-5">
                            <img src="{{$user->getMedia('avatars')->first()->getUrl()}}" alt="Ringo"
                                 class="imgUsuario sombraImgUser2">
                        </div>

                        <div class="col-xs-7 col-md-7 padding-top-20 padding0">
                            <span class="texto20 sinkinSans600SB colorN margin-right-15">{{$user->name}}</span>
                            @if($user->id == \Auth::User()->id)
                                {{--<a href="{{route('profile.edit',['userid'=> \Auth::User()->id])}}"><span class="ti-marker-alt texto20 colorN"></span></a>--}}
                                <a href="{{route('profile.edit',$user->id)}}"><span
                                            class="ti-marker-alt texto20 colorN"></span></a>
                            @endif
                            <br>

                            <span class="sinkinSans500MI texto16">{{$user->getProfile->getCity->country->name}}</span>
                        </div>
                    </div>
                    <div class="row hidden-xs padding-top-20">
                        <div class="col-xs-12">
                            <h5 class="borderBottomG colorN sinkinSans600SB"><span
                                        class="ti-bar-chart texto14 padding-top5 margin-right-10"></span>@lang('views.statistics')
                            </h5>
                        </div>
                        <div class="col-xs-12 sinkinSans300L colorV">
                            <div class="padding-top-10">
                                <div class="col-xs-9 col-sm-8 col-lg-7"><span class="colorV margin-right-20">@lang('views.created_raffles')
                                        :</span>
                                </div>
                                <div class="col-xs-3 col-sm-4 col-lg-5"><strong
                                            class="colorN sinkinSans600SB">{{ count($user->getRaffles) }}</strong><br>
                                </div>
                            </div>
                            <div class="padding-top-20">
                                <div class="col-xs-9 col-sm-8 col-lg-7"><span class="colorV margin-right-20">@lang('views.winned_raffles')
                                        :</span>
                                </div>
                                <div class="col-xs-3 col-sm-4 col-lg-5"><strong
                                            class="colorN sinkinSans600SB">{{ count($user->WinnedRaffles()) }}</strong><br>
                                </div>
                            </div>
                            <div class="padding-top-20">
                                <div class="col-xs-9 col-sm-8 col-lg-7"><span class="colorV margin-right-20">@lang('views.shared_raffles')
                                        :</span>
                                </div>
                                <div class="col-xs-3 col-sm-4 col-lg-5"><strong
                                            class="colorN sinkinSans600SB">{{ count($user->getReferralsBuys->groupBy('raffle_id')) }}</strong><br>
                                </div>
                            </div>
                            <div class="padding-top-20">
                                <div class="col-xs-9 col-sm-8 col-lg-7"><span class="colorV margin-right-20">@lang('views.sold_tickets')
                                        :</span>
                                </div>
                                <div class="col-xs-3 col-sm-4 col-lg-5"><strong
                                            class="colorN sinkinSans600SB">{{ $user->getSoldTicketsCount() }}</strong><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 padding-top-20">
                            <h5 class="borderBottomG colorN sinkinSans600SB"><span
                                        class="ti-agenda texto14 padding-top5 margin-right-10"></span>@lang('views.contacts')
                            </h5>

                            @if($user->getProfile->phone)
                                <div class="phone sinkinSans500M padding-top-20">
                                    <span class="ti-mobile colorV"></span>
                                    {{$user->getProfile->phone}}
                                </div>
                            @endif
                            <div class="correo sinkinSans500M padding-top-20">
                                <span class="ti-email colorV  margin-right-10"></span>
                                {{$user->email}}
                            </div>
                        </div>
                        @if($user->id == \Auth::User()->id)
                            <div class="col-xs-12 padding-top-20">
                                <h5 class="borderBottomG colorN sinkinSans600SB"><span
                                            class="ti-wallet texto14 padding-top5 margin-right-10"></span>@lang('views.my_account')
                                </h5>
                                <span class="texto14 sinkinSans400R colorV padding-left30">Total</span>
                                <div class="margin-bottom-40 padding-top5">
                                    <div class="pull-left padding-top5">
                                        <span class="ti-money colorV margin-right5"></span>
                                        <span class="borderDashed sinkinSans500M padding15">{{$user->getProfile->balance}}</span>
                                    </div>
                                    <div class="pull-right">
                                        <button type="button"
                                                class="btn btn-primary bg_green extraer text-uppercase sinkinSans700B">
                                            @lang('views.extract')
                                        </button>
                                    </div>
                                </div>
                                <div class="col-xs-12 preciosExtraer  padding-left-0">
                                    <div id="precio" class="panel-collapse collapse" role="tabpanel"
                                         aria-labelledby="headingThree" aria-expanded="true" style="">
                                        <div class="panel-body">
                                            <div class="row padding-top-15 ">
                                                <div class="col-xs-7 padding-left-0 padding-top-10">
                                                    <i class="fa fa-dollar colorV margin-right-10"></i>
                                                    <span class="colorV sinkinSans400I"> @lang('views.by_raffle')</span>
                                                </div>
                                                <div class="col-xs-5 padding-rigth-0 padding-left-0 borderBottomG">
                                                    <span class="sinkinSans500M">20.00 USD</span>
                                                </div>
                                            </div>
                                            <div class="row padding-top5">
                                                <div class="col-xs-7 padding-left-0 padding-top-10">
                                                    <i class="fa fa-dollar colorV margin-right-10"></i>
                                                    <span class="colorV sinkinSans400I">@lang('views.by_commission')</span>
                                                </div>
                                                <div class="col-xs-4 padding-rigth-0 padding-left-0 borderBottomG">
                                                    <span class="sinkinSans500M">400.00 USD</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-heading" role="tab" id="">
                                        <div class="tools">
                                            <a class="paddingCollapse" data-toggle="collapse" data-parent="#accordion"
                                               href="#precio" aria-expanded="true" aria-controls="collapseThree"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="bottomLIzquierdo hidden-xs"></div>
            </div>
            <!--PANEL Solo visible en la vista movil-->
            <div class="col-xs-12 visible-xs paddingLeft0 padding-rigth-0 padding-bottom30">
                <div class="paddingLeft0 ">
                    <div class="panel-body">
                        <ul class="nav nav-tabs bg-panelUsuarioR sinkinSans600SB padding-left150" id="myTab">
                            <li class="active stylePanelU"><a data-toggle="tab"
                                                              class="panelUsuario colorV ti-bar-chart texto20"
                                                              href="#estadisticas"
                                                              aria-expanded="true"></a></li>
                            <li class="stylePanelU"><a data-toggle="tab" class="panelUsuario colorV ti-agenda texto20"
                                                       href="#contactos"
                                                       aria-expanded="false"></a></li>
                            <li class="stylePanelU"><a data-toggle="tab" class="panelUsuario colorV ti-wallet texto20"
                                                       href="#micuenta"
                                                       aria-expanded="true"></a></li>
                        </ul>
                        <div class="tab-content padding-top-20">
                            <div class="tab-pane active in" id="estadisticas">
                                <div class="col-xs-12 colorV sinkinSans300L">
                                    <div class="padding-top-10">
                                        <div class="col-xs-6 col-sm-8"><span class="colorV margin-right-20">@lang('views.created_raffles')
                                                :</span>
                                        </div>
                                        <div class="col-xs-6 col-sm-4"><strong
                                                    class="colorN sinkinSans600SB">100%</strong><br></div>
                                    </div>
                                    <div class="padding-top-20">
                                        <div class="col-xs-6 col-sm-8"><span class="colorV margin-right-20">@lang('views.winned_raffles')
                                                :</span>
                                        </div>
                                        <div class="col-xs-6 col-sm-4"><strong
                                                    class="colorN sinkinSans600SB">80%</strong><br></div>
                                    </div>
                                    <div class="padding-top-20">
                                        <div class="col-xs-6 col-sm-8"><span class="colorV margin-right-20">@lang('views.shared_raffles')
                                                :</span>
                                        </div>
                                        <div class="col-xs-6 col-sm-4"><strong
                                                    class="colorN sinkinSans600SB">100%</strong><br></div>
                                    </div>
                                    <div class="padding-top-20">
                                        <div class="col-xs-6 col-sm-8"><span class="colorV margin-right-20">@lang('views.sold_tickets')
                                                :</span>
                                        </div>
                                        <div class="col-xs-6 col-sm-4"><strong
                                                    class="colorN sinkinSans600SB">100%</strong><br></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane " id="contactos">
                                <div class="col-xs-12 sinkinSans300LI">
                                    <div class="padding-top-20">
                                        <span class="ti-mobile colorV"></span>
                                        +534518478
                                    </div>
                                    <div class="padding-top-20">
                                        <span class="ti-email colorV  margin-right-10"></span>
                                        janedoe@nauta.com.cu
                                    </div>
                                    <div class="padding-top-20">
                                        <span class="ti-facebook colorV texto14 margin-right-10"></span>
                                        janedoe
                                    </div>
                                    <div class="padding-top-20">
                                        <span class="ti-twitter colorV texto14 margin-right-10"></span>
                                        @janedoe
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="micuenta">
                                <div class="col-xs-12 sinkinSans300LI ">
                                    <span class="texto14 colorV padding-left30">Total</span>
                                    <div class="col-xs-12 padding-bottom20 padding-top5">
                                        <div class="col-xs-8 texto14  padding-top5">
                                            <span class="ti-money colorV margin-right5"></span>
                                            <span class="borderDashed padding15">{{$user->getProfile->balance}}</span>
                                        </div>
                                        <div class="col-xs-4">
                                            <button type="button"
                                                    class="btn btn-primary bg_green extraer text-uppercase">
                                                @lang('views.extract')
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 preciosExtraer padding-left-0">
                                        <div id="precio1" class="panel-collapse collapse" role="tabpanel"
                                             aria-labelledby="headingThree" aria-expanded="true" style="">
                                            <div class="panel-body">
                                                <div class="row padding-top-15">
                                                    <div class="col-xs-7 padding-left-0 texto14 padding-top-10">
                                                        <i class="fa fa-dollar colorV margin-right-10"></i>
                                                        <span class="colorV italic"> @lang('views.by_raffle')</span>
                                                    </div>
                                                    <div class="col-xs-5 padding-rigth-0 borderBottomG">
                                                        <span class="texto14">20.00 USD</span>
                                                    </div>
                                                </div>
                                                <div class="row padding-top5">
                                                    <div class="col-xs-7 padding-left-0 padding-top5 texto14 padding-top-10">
                                                        <i class="fa fa-dollar colorV margin-right-10"></i>
                                                        <span class="colorV italic">@lang('views.by_commission')</span>
                                                    </div>
                                                    <div class="col-xs-5 padding-rigth-0 borderBottomG">
                                                        <span class="texto14">400.00 USD</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-heading " role="tab" id="">
                                            <div class="tools">
                                                <a class="paddingCollapse" data-toggle="collapse"
                                                   data-parent="#accordion"
                                                   href="#precio1" aria-expanded="true"
                                                   aria-controls="collapseThree"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--FIN Solo visible en la vista movil-->

            </div>
            <!--Contenido usuario-->
            <div class="col-xs-12 col-sm-7 col-md-8 col-lg-7 padding-top-50">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel-heading borderBottomV" role="tab" id="">
                            <div class="pull-left">
                                <span class="colorN text-uppercase sinkinSans600SB">@lang('views.raffles')</span>
                            </div>
                            <div class="tools pull-right">
                                <a class="paddingCollapse" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseThree" aria-expanded="true" aria-controls="collapseThree"></a>
                            </div>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="headingThree" aria-expanded="true" style="">
                            <div class="panel-body">
                                <ul class="padding-top-20 nav nav-tabs sinkinSans600SB padding-left150" id="myTab">

                                    <li class="active"><a data-toggle="tab" class="ticket text-uppercase colorN"
                                                          href="#creadas"
                                                          aria-expanded="true">@lang('views.created')</a></li>
                                    <li class=""><a data-toggle="tab" class="ticket text-uppercase colorN"
                                                    href="#participo"
                                                    aria-expanded="false">@lang('views.participating')</a></li>
                                    <li><a data-toggle="tab" class="ticket text-uppercase colorN" href="#siguiendo"
                                           aria-expanded="false">@lang('views.following')</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane " id="todas">

                                    </div>
                                    <div class="tab-pane active in" id="creadas">
                                        @foreach($user->getRaffles as $raffle)
                                            <div class="col-xs-6 col-lg-3 col-sm-4 padding-top-15">
                                                <a href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}">
                                                    <img src="{{ $raffle->getMedia('raffles')->first()->getUrl() }}"
                                                         class="imgRifas">
                                                    <div class="porciento">
                                                        <div class=" text-center">
                                                <span class="chartB chart-porcientoR"
                                                      data-percent="{{round($raffle->getProgress())}}">
                                                    <span class="percentR">{{round($raffle->getProgress())}}%</span>
                                                </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="tab-pane" id="participo">
                                        @foreach($user->getRafflesBuyed as $raffle)
                                            <div class="col-xs-6 col-lg-3 col-sm-4 padding-top-15">
                                                <a href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}">
                                                    <img src="{{ $raffle->getMedia('raffles')->first()->getUrl() }}"
                                                         class="imgRifas">
                                                    <div class="porciento">
                                                        <div class=" text-center">
                                                <span class="chartB chart-porcientoR"
                                                      data-percent="{{round($raffle->getProgress())}}">
                                                    <span class="percentR">{{round($raffle->getProgress())}}%</span>
                                                </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="tab-pane" id="siguiendo">
                                        @foreach($user->getRafflesFollowed as $raffle)
                                            <div class="col-xs-6 col-lg-3 col-sm-4 padding-top-15">
                                                <a href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}">
                                                    <img src="{{ $raffle->getMedia('raffles')->first()->getUrl() }}"
                                                         class="imgRifas">
                                                    <div class="porciento">
                                                        <div class=" text-center">
                                                <span class="chartB chart-porcientoR"
                                                      data-percent="{{round($raffle->getProgress())}}">
                                                    <span class="percentR">{{round($raffle->getProgress())}}%</span>
                                                </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 padding-top-20">
                        <div class="panel-heading borderBottomV" role="tab" id="">
                            <div class="pull-left">
                                <span class="colorN text-uppercase sinkinSans600SB">tickets</span>
                            </div>
                            <div class="tools pull-right">
                                <a class="collapsed paddingCollapse" data-toggle="collapse" data-parent="#accordion"
                                   href="#ticket" aria-expanded="true" aria-controls="collapseThree"></a>
                            </div>
                        </div>
                        <div id="ticket" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingThree" aria-expanded="false" style="">
                            <div class="panel-body">
                                <ul class="padding-top-20 nav nav-tabs sinkinSans600SB padding-left150" id="myTab">
                                    <li class="active"><a data-toggle="tab" class="ticket text-uppercase colorN"
                                                          href="#vendidos"
                                                          aria-expanded="true">@lang('views.sold')</a></li>
                                    <li class=""><a data-toggle="tab" class="ticket text-uppercase colorN"
                                                    href="#comprados"
                                                    aria-expanded="false">@lang('views.purchased')</a></li>
                                </ul>
                                <div class="tab-content">

                                    <div class="tab-pane active in" id="vendidos">
                                        @foreach($user->getRafflesSelled as $raffle)
                                            <div class="col-xs-6 col-lg-3 col-sm-4 padding-top-15 paddingLeft0 padding-rigth-0">
                                                <a href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}">
                                                    <div class="pull-left">
                                                        @if(count($raffle->getMedia('raffles')) > 0)
                                                            <img src="{{$raffle->getMedia('raffles')->first()->getUrl()}}"
                                                                 class="imgTicket">
                                                        @endif
                                                    </div>
                                                    <div class="pull-left bg-b colorV textoCenter">
                                                        <h4 class="sinkinSans600SB">{{$raffle->getTicketsSold()}}</h4>
                                                        <h5 class="text-uppercase texto10 sinkinSans300L">tickets</h5>
                                                    </div>
                                                </a>
                                            </div>

                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="comprados">
                                        @foreach($user->getRafflesBuyed as $raffle)
                                            <div class="col-xs-6 col-lg-3 col-sm-4 padding-top-15 paddingLeft0 padding-rigth-0">
                                                <a href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}">
                                                    <div class="pull-left">
                                                        @if(count($raffle->getMedia('raffles')) > 0)
                                                            <img src="{{$raffle->getMedia('raffles')->first()->getUrl()}}"
                                                                 class="imgTicket">
                                                        @endif
                                                    </div>
                                                    <div class="pull-left bg-b colorV textoCenter">
                                                        <h4 class="sinkinSans600SB">{{count($user->getTicketsByRaffle($raffle->id))}}</h4>
                                                        <h5 class="text-uppercase texto10 sinkinSans300L">tickets</h5>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 padding-top-20">
                        <div class="panel-heading borderBottomV" role="tab" id="">
                            <div class="pull-left">
                                <span class="colorN text-uppercase sinkinSans600SB">@lang('views.users')</span>
                            </div>
                            <div class="tools pull-right">
                                <a class="collapsed paddingCollapse" data-toggle="collapse" data-parent="#accordion"
                                   href="#usuarios" aria-expanded="false" aria-controls="collapseThree"></a>
                            </div>
                        </div>
                        <div id="usuarios" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingThree" aria-expanded="false" style="">
                            <div class="panel-body">
                                <ul class="padding-top-20 nav nav-tabs sinkinSans600SB padding-left150" id="myTab">

                                    <li class=""><a data-toggle="tab" class="ticket text-uppercase colorN"
                                                    href="#seguidos"
                                                    aria-expanded="false">@lang('views.followed')</a></li>
                                    <li class="active"><a data-toggle="tab" class="ticket text-uppercase colorN"
                                                          href="#mesiguen"
                                                          aria-expanded="true">@lang('views.follow_me')</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane " id="seguidos">
                                    </div>
                                    <div class="tab-pane active in" id="mesiguen">
                                        <div class="row">
                                            <div class="col-md-12">


                                                <div class="slickUsuario" id="normalSlick">
                                                    @foreach($user->getFollowers as $follower)
                                                        <div class=" slick-list ">
                                                            <img src="{{ $follower->getMedia('avatars')->first() ->getUrl()}}"
                                                                 class="imgUsuario sombraImgUser2"
                                                                 alt="imgUser">
                                                            <h6 class="hidden-xs sinkinSans600SB">{{ $follower->name }} {{ $follower->lastname }}</h6>
                                                            <span class="texto10 sinkinSans500MI padding-left10 hidden-xs">{{ $follower->getProfile->getCity->country->name }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-xs-12 bg-popoverU" >
                                                <div class="colorV visible-xs text-center texto14 padding-top-30"><span
                                                            class="sinkinSans600SB text-uppercase" id="name">Jane Doe /</span>
                                                    <span class="sinkinSans300LI" id="country">Pais</span>
                                                </div>
                                                <div class="col-md-6 padding-top-20 sinkinSans400R">
                                                    <div class="col-xs-12 padding-top-20 paddingLeft0">
                                                        <div class="col-xs-9 col-md-6"><span
                                                                    class="colorN margin-right-20" >@lang('views.created_raffles'):</span>
                                                        </div>
                                                        <div class="col-xs-3 col-md-6"><strong
                                                                    class="colorV sinkinSans600SB" id="created_raffles">20%</strong><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 padding-top-20 paddingLeft0">
                                                        <div class="col-xs-9 col-md-6"><span
                                                                    class="colorN margin-right-20">Rifas ganadas:</span>
                                                        </div>
                                                        <div class="col-xs-3 col-md-6"><strong
                                                                    class="colorV sinkinSans600SB">100%</strong><br>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 padding-top-20 sinkinSans400R">
                                                    <div class="col-xs-12 padding-top-20 paddingLeft0">
                                                        <div class="col-xs-9 col-md-6"><span
                                                                    class="colorN margin-right-20">Rifas compartidas:</span>
                                                        </div>
                                                        <div class="col-xs-3 col-md-6"><strong
                                                                    class="colorV sinkinSans600SB">20%</strong><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 padding-top-20 paddingLeft0">
                                                        <div class="col-xs-9 col-md-6"><span
                                                                    class="colorN margin-right-20">Tickets vendidos:</span>
                                                        </div>
                                                        <div class="col-xs-3 col-md-6"><strong
                                                                    class="colorV sinkinSans600SB">20%</strong><br>
                                                        </div>
                                                    </div>
                                                </div>

                                                <a href="" class="floatRight sinkinSans200LI padding-top-30 colorN">ir
                                                    al
                                                    perfil
                                                    <span class="ti-angle-right texto16 colorN texto-negrita padding-top5"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--FIN Contenido rifas-->


            @include('partials.frontend.promotions')
        </div>
    </div>
@stop
@section('additional_scripts')
    <script>
        $('.slickUsuario').slick({
            autoplay: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            infinite: true,
            pauseOnHover: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                    }
                },

            ]
        });

    </script>
@stop
