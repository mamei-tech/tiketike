@extends('layouts.base')
@section('title',trans('views.profile'))
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
                            <img src="{{ $avatar }}" alt="Ringo"
                                 class="imgUsuario sombraImgUser2">
                        </div>
                        <div class="col-xs-7 col-md-7 padding-top-20 padding0">
                            <span class="texto20 sinkinSans600SB colorN margin-right-15">{{$current->name}}</span>
                            @if($current->id == \Auth::User()->id)
                                {{--<a href="{{route('profile.edit',['userid'=> \Auth::User()->id])}}"><span class="ti-marker-alt texto20 colorN"></span></a>--}}
                                <a href="{{route('profile.edit',$current->id)}}"><span
                                            class="ti-marker-alt texto20 colorN"></span></a>
                            @endif
                            <br>

                            <span class="sinkinSans500MI texto16">{{ $country }}</span>
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
                                            class="colorN sinkinSans600SB">{{ $rafflesCount }}</strong><br>
                                </div>
                            </div>
                            <div class="padding-top-20">
                                <div class="col-xs-9 col-sm-8 col-lg-7"><span class="colorV margin-right-20">@lang('views.winned_raffles')
                                        :</span>
                                </div>
                                <div class="col-xs-3 col-sm-4 col-lg-5"><strong
                                            class="colorN sinkinSans600SB">{{ $winnedRaffles }}</strong><br>
                                </div>
                            </div>
                            <div class="padding-top-20">
                                <div class="col-xs-9 col-sm-8 col-lg-7"><span class="colorV margin-right-20">@lang('views.shared_raffles')
                                        :</span>
                                </div>
                                <div class="col-xs-3 col-sm-4 col-lg-5"><strong
                                            class="colorN sinkinSans600SB">{{ $sharedRaffles }}</strong><br>
                                </div>
                            </div>
                            <div class="padding-top-20">
                                <div class="col-xs-9 col-sm-8 col-lg-7"><span class="colorV margin-right-20">@lang('views.sold_tickets')
                                        :</span>
                                </div>
                                <div class="col-xs-3 col-sm-4 col-lg-5"><strong
                                            class="colorN sinkinSans600SB">{{ $soldTickets }}</strong><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 padding-top-20">
                            <h5 class="borderBottomG colorN sinkinSans600SB"><span
                                        class="ti-agenda texto14 padding-top5 margin-right-10"></span>@lang('views.contacts')
                            </h5>

                            @if($currentProfile->phone)
                                <div class="phone sinkinSans500M padding-top-20">
                                    <span class="ti-mobile colorV"></span>
                                    {{$currentProfile->phone}}
                                </div>
                            @endif
                            <div class="correo sinkinSans500M padding-top-20">
                                <span class="ti-email colorV  margin-right-10"></span>
                                {{$current->email}}
                            </div>
                        </div>


                        @if($current->id != \Auth::User()->id )
                            @if(!$isFollower)
                                <div class="pull-left padding-top-20">
                                    <a href="{{route('user.follow',['userid'=>$current->id])}}"
                                       class="btn btn-primary bg_green extraer sinkinSans700B text-uppercase"
                                       type="button">Seguir</a>
                                </div>
                            @else
                                <div class="pull-left padding-top-20">
                                    <a href="{{route('user.unfollow',['userid'=>$current->id])}}"
                                       class="btn btn-primary bg_green extraer sinkinSans700B text-uppercase"
                                       type="button">Dejar de Seguir</a>
                                </div>
                            @endif

                        @endif

                        @if($current->id == \Auth::User()->id)
                            <div class="col-xs-12 padding-top-20">
                                <h5 class="borderBottomG colorN sinkinSans600SB"><span
                                            class="ti-wallet texto14 padding-top5 margin-right-10"></span>@lang('views.my_account')
                                </h5>
                                <span class="texto14 sinkinSans400R colorV padding-left30">Total</span>
                                <div class="margin-bottom-40 padding-top5">
                                    <div class="pull-left padding-top5">
                                        <span class="ti-money colorV margin-right5"></span>
                                        <span class="borderDashed sinkinSans500M padding15">{{ $balance }}</span>
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
                                                    <span class="sinkinSans500M">{{ $raffleMoney }}
                                                        USD</span>
                                                </div>
                                            </div>
                                            <div class="row padding-top5">
                                                <div class="col-xs-7 padding-left-0 padding-top-10">
                                                    <i class="fa fa-dollar colorV margin-right-10"></i>
                                                    <span class="colorV sinkinSans400I">@lang('views.by_commission')</span>
                                                </div>
                                                <div class="col-xs-4 padding-rigth-0 padding-left-0 borderBottomG">
                                                    <span class="sinkinSans500M">{{ $raferralMoney }}
                                                        USD</span>
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
                                        <div class="col-xs-9 col-sm-8"><span class="colorV margin-right-20">@lang('views.created_raffles')
                                                :</span>
                                        </div>
                                        <div class="col-xs-3 col-sm-4"><strong
                                                    class="colorN sinkinSans600SB">{{$rafflesCount }}</strong><br></div>
                                    </div>
                                    <div class="padding-top-20">
                                        <div class="col-xs-9 col-sm-8"><span class="colorV margin-right-20">@lang('views.winned_raffles')
                                                :</span>
                                        </div>
                                        <div class="col-xs-3 col-sm-4"><strong
                                                    class="colorN sinkinSans600SB">{{ $winnedRaffles }}</strong><br>
                                        </div>
                                    </div>
                                    <div class="padding-top-20">
                                        <div class="col-xs-9 col-sm-8"><span class="colorV margin-right-20">@lang('views.shared_raffles')
                                                :</span>
                                        </div>
                                        <div class="col-xs-3 col-sm-4"><strong
                                                    class="colorN sinkinSans600SB">{{ $sharedRaffles }}</strong><br>
                                        </div>
                                    </div>
                                    <div class="padding-top-20">
                                        <div class="col-xs-9 col-sm-8"><span class="colorV margin-right-20">@lang('views.sold_tickets')
                                                :</span>
                                        </div>
                                        <div class="col-xs-3 col-sm-4"><strong
                                                    class="colorN sinkinSans600SB">{{ $soldTickets  }}</strong><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane " id="contactos">
                                <div class="col-xs-12 sinkinSans300LI">
                                    @if($currentProfile->phone)
                                        <div class="padding-top-20">
                                            <span class="ti-mobile colorV"></span>
                                            {{$currentProfile->phone}}
                                        </div>
                                    @endif
                                    <div class="padding-top-20">
                                        <span class="ti-email colorV  margin-right-10"></span>
                                        {{$current->email}}
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="micuenta">
                                <div class="col-xs-12 sinkinSans300LI ">
                                    <span class="texto14 colorV padding-left30">Total</span>
                                    <div class="col-xs-12 padding-bottom20 padding-top5">
                                        <div class="col-xs-8 texto14  padding-top5">
                                            <span class="ti-money colorV margin-right5"></span>
                                            <span class="borderDashed padding15">{{ $balance }}</span>
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
                                                        <span class="texto14">{{ $raffleMoney }} USD</span>
                                                    </div>
                                                </div>
                                                <div class="row padding-top5">
                                                    <div class="col-xs-7 padding-left-0 padding-top5 texto14 padding-top-10">
                                                        <i class="fa fa-dollar colorV margin-right-10"></i>
                                                        <span class="colorV italic">@lang('views.by_commission')</span>
                                                    </div>
                                                    <div class="col-xs-5 padding-rigth-0 borderBottomG">
                                                        <span class="texto14">{{ $raferralMoney }}
                                                            USD</span>
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


                            @if($current->id != \Auth::User()->id )
                                @if(!$isFollower)
                                    <div class="center-textR" style="padding-top: 120px">
                                        <a href="{{route('user.follow',['userid'=>$current->id])}}"
                                           class="btn btn-primary bg_green extraer sinkinSans700B text-uppercase"
                                           type="button">Seguir</a>
                                    </div>

                                @else
                                    <div class="center-textR" style="padding-top: 120px">
                                        <a href="{{route('user.follow',['userid'=>$current->id])}}"
                                           class="btn btn-primary bg_green extraer sinkinSans700B text-uppercase"
                                           type="button">Dejar de seguir</a>
                                    </div>
                                @endif


                            @endif


                        </div>
                    </div>
                </div>


            </div>

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
                            <div class="panel-body text-center">
                                <ul class="nav nav-tabs sinkinSans600SB" id="myTab" style="display: inline-block">

                                    <li class=""><a data-toggle="tab" class="ticket text-uppercase colorN"
                                                    href="#creadas"
                                                    aria-expanded="true">@lang('views.created')</a></li>
                                    <li class=""><a data-toggle="tab" class="ticket text-uppercase colorN"
                                                    href="#participo"
                                                    aria-expanded="false">@lang('views.participating')</a></li>
                                    <li class="active"><a data-toggle="tab" class="ticket text-uppercase colorN"
                                                          href="#siguiendo"
                                                          aria-expanded="false">@lang('views.following')</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active in" id="creadas">
                                        @foreach($raffles as $raffle)
                                            <div class="col-xs-6 col-lg-3 col-sm-4 padding-top-15">
                                                <a href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}">
                                                    <img src="{{ $raffle->getMedia('raffles')->first()->getUrl() }}"
                                                         class="imgRifas">


                                                    <div class="porciento">
                                                        <div class=" text-center">
                                                          <span class="chartB chart-porcientoR"
                                                                data-percent="{{round($raffle->progress)}}">
                                                             <span class="percentR">{{round($raffle->progress)}}%</span>
                                                          </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="tab-pane" id="participo">
                                        @foreach($rafflesBuyed as $raffle)
                                            <div class="col-xs-6 col-lg-3 col-sm-4 padding-top-15">
                                                <a href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}">
                                                    <img src="{{ $raffle->getImage() }}"
                                                         class="imgRifas">
                                                    <div class="porciento">
                                                        <div class=" text-center">
                                                <span class="chartB chart-porcientoR"
                                                      data-percent="{{round($raffle->progress)}}">
                                                    <span class="percentR">{{round($raffle->progress)}}%</span>
                                                </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="tab-pane" id="siguiendo">
                                        @foreach($current->getRafflesFollowed as $raffle)
                                            <div class="col-xs-6 col-lg-3 col-sm-4 padding-top-15">
                                                <a href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}">
                                                    <img src="{{ $raffle->getMedia('raffles')->first()->getUrl() }}"
                                                         class="imgRifas">
                                                    <div class="porciento">
                                                        <div class=" text-center">
                                                <span class="chartB chart-porcientoR"
                                                      data-percent="{{round($raffle->progress)}}">
                                                    <span class="percentR">{{round($raffle->progress)}}%</span>
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
                            <div class="panel-body text-center">
                                <ul class="nav nav-tabs sinkinSans600SB" id="myTab" style="display: inline-block">
                                    <li class="active"><a data-toggle="tab" class="ticket text-uppercase colorN"
                                                          href="#vendidos"
                                                          aria-expanded="true">@lang('views.sold')</a></li>
                                    <li class=""><a data-toggle="tab" class="ticket text-uppercase colorN"
                                                    href="#comprados"
                                                    aria-expanded="false">@lang('views.purchased')</a></li>
                                </ul>
                                <div class="tab-content">

                                    <div class="tab-pane active in" id="vendidos">
                                        @foreach($current->getRafflesSelled as $raffle)
                                            <div class="col-xs-6 col-lg-3 col-sm-4 padding-top-15 ">
                                                <a href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}">
                                                    <div class="pull-left">
                                                        <img src="{{$raffle->getMedia('raffles')->first()->getUrl()}}"
                                                             class="imgTicket">
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
                                        @foreach($current->getRafflesBuyed as $raffle)
                                            <div class="col-xs-6 col-lg-3 col-sm-4 padding-top-15 ">
                                                <a href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}">
                                                    <div class="pull-left">
                                                        <img src="{{$raffle->getMedia('raffles')->first()->getUrl()}}"
                                                             class="imgTicket">
                                                    </div>
                                                    <div class="pull-left bg-b colorV textoCenter">
                                                        <h4 class="sinkinSans600SB">{{count($current->getTicketsByRaffle($raffle->id))}}</h4>
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
                                <a id="openusers" class="collapsed paddingCollapse" data-toggle="collapse"
                                   data-parent="#accordion"
                                   href="#usuarios" aria-expanded="true" aria-controls="collapseThree"></a>
                            </div>
                        </div>
                        <div id="usuarios" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingThree" aria-expanded="true" style="">
                            <div class="panel-body text-center">
                                <ul class="nav nav-tabs sinkinSans600SB" id="myTab" style="display: inline-block">

                                    <li class=""><a id="seguidosopen" data-toggle="tab"
                                                    class="ticket text-uppercase colorN"
                                                    href="#seguidos"
                                                    aria-expanded="false">@lang('views.followed')</a></li>
                                    <li class="active"><a id="mesiguenopen" data-toggle="tab"
                                                          class="ticket text-uppercase colorN"
                                                          href="#mesiguen"
                                                          aria-expanded="true">@lang('views.follow_me')</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane " id="seguidos">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="slickFollows" id="">
                                                    @foreach($current->getFollows as $follow)
                                                        <div class="slick-list follow" id="{{$follow->id}}"
                                                             style="overflow: auto">
                                                            <a href="{{ route('profile.info',$follow->id) }}">
                                                                <img src="{{ $follow->getMedia('avatars')->first() ->getUrl()}}"
                                                                     class="imgUsuario sombraImgUser2"
                                                                     alt="imgUser">
                                                            </a>
                                                            <h6 class=" sinkinSans600SB">{{ $follow->fullname }}</h6>
                                                            <span class="texto10 sinkinSans500MI padding-left10 hidden-xs">{{ $follow->getProfile->getCity->country->name }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane active" id="mesiguen">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="helper_for_followers"
                                                     id="{{ count($current->getFollowers) }}"
                                                     style="display: none"></div>
                                                <div class="slickFollowers" id="normalSlick-followers">
                                                    @foreach($current->getFollowers as $follower)
                                                        <div class="slick-list follower" id="{{$follower->id}}"
                                                             style="overflow: auto">
                                                            <a href="{{ route('profile.info',$follower->id) }}">
                                                                <img src="{{ $follower->getMedia('avatars')->first() ->getUrl()}}"
                                                                     class="imgUsuario sombraImgUser2"
                                                                     alt="imgUser">
                                                            </a>
                                                            <h6 class="sinkinSans600SB">{{ $follower->fullname }}</h6>
                                                            <span class="texto10 sinkinSans500MI padding-left10 hidden-xs">{{ $follower->getProfile->getCity->country->name }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            @include('partials.frontend.promotions')
        </div>
    </div>
@stop
@section('additional_scripts')

    <script type="text/javascript">
        $(document).ready(function () {


            $('.slickFollowers').slick({
                autoplay: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                infinite: true,
                adaptativeHeight: true,
                pauseOnHover: true,
                swipeToSlide: true,
                initialSlide: 0,
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

            $('#openusers').on('click', function () {
                setTimeout(function () {
                    $('.slickFollowers').slick('refresh');
                }, 10);
            });

            $('#mesiguenopen').on('click', function () {
                setTimeout(function () {
                    $('.slickFollowers').slick('refresh');
                }, 10);
            });


            $('.slickFollows').slick({
                autoplay: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                infinite: true,
                arrows: true,
                pauseOnHover: true,
                swipeToSlide: true,
                initialSlide: 0,
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

            $('#seguidosopen').on('click', function () {
                setTimeout(function () {
                    $('.slickFollows').slick('refresh');
                }, 10);
            });


            revapi = jQuery('.tp-banner').show().revolution({
                delay: 1000,
                startwidth: 1170,
                startheight: 500,
                hideThumbs: true,
                fullWidth: "on",
                fullScreen: "off",
                touchenabled: "on",                      // Enable Swipe Function : on/off
                onHoverStop: "on",                       // Stop Banner Timet at Hover on Slide on/off
                fullScreenOffsetContainer: ""
            });
        });
    </script>
@stop
