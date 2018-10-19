@extends('layouts.base')
@section('content')
    @include('partials.frontend.header')
    @include('partials.front_modals.filters')
    @include('partials.front_modals.mobile_suggest')
    <div class="container contenido">
        <div class="row ">
            <!--categoria y rifas-->
            <div class="col-sm-4 col-lg-3 hidden-xs padding-rigth-0">
                <div class="categoria">
                    <div class="listadoCategoria">
                        <h4 class="text-uppercase sinkinSans600SB colorV">categorías</h4>
                        <ul class="nav sinkinSans400R">
                            <li><a href="#" class="colorN text-uppercase">Todos</a></li>
                            <li class="active"><a href="#" class="colorN text-uppercase">Celulares</a></li>
                            <li><a href="#" class="colorN text-uppercase">Ropa/Calzado</a></li>
                            <li><a href="#" class="colorN text-uppercase">Electrodomestico</a></li>
                            <li><a href="#" class="colorN text-uppercase">autos/piezas</a></li>
                            <li><a href="#" class="colorN text-uppercase">PC/acsesorios</a></li>
                            <li><a href="#" class="colorN text-uppercase">Cosmeticos</a></li>
                            <li><a href="#" class="colorN text-uppercase">Joyas</a></li>
                            <li><a href="#" class="colorN text-uppercase">Mobiliario</a></li>
                        </ul>
                    </div>
                </div>
                <div class="filtrarpor">
                    <h4 class="text-uppercase sinkinSans600SB colorV">filtrar por</h4>
                    <div class="bg_V text-uppercase">
                        <label class="colorB styleEncabezado sinkinSans300L">paises</label>
                    </div>
                    <div class="paddingFiltrar">
                        <div class="america">
                            <div class="panel-heading" role="tab" id="">
                                <div class="subtPais caption checkbox sinkinSans300L">
                                    <label>
                                        <input class="letra-naranja" type="checkbox">
                                        América
                                    </label>
                                </div>
                                <div class="tools">
                                    <a class="paddingCollapse" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseThree" aria-expanded="true" aria-controls="collapseThree"></a>
                                </div>

                            </div>
                            <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel"
                                 aria-labelledby="headingThree" aria-expanded="true" style="">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6 texto10 sinkinSans300L">
                                            <div class="checkbox">
                                                <label class="texto10">
                                                    <input value="remember-me" type="checkbox">EEUU
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label class="texto10">
                                                    <input value="remember-me" type="checkbox">Canadá
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 texto10 sinkinSans300L">
                                            <div class="checkbox">
                                                <label class="texto10">
                                                    <input class="" type="checkbox">
                                                    Colombia
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label class="texto10">
                                                    <input value="remember-me" type="checkbox">Brasil
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="europa">
                            <div class="panel-heading" role="tab" id="">
                                <div class="subtPais caption checkbox sinkinSans300L">
                                    <label>
                                        <input class="letra-naranja" type="checkbox">
                                        Europa
                                    </label>
                                </div>
                                <div class="tools">
                                    <a class="collapsed paddingCollapse" data-toggle="collapse" data-parent="#accordion"
                                       href="#europa" aria-expanded="true" aria-controls="collapseThree"></a>
                                </div>

                            </div>
                            <div id="europa" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingThree" aria-expanded="true" style="">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6 texto10 sinkinSans300L">
                                            <div class="checkbox">
                                                <label class="texto10">
                                                    <input value="remember-me" type="checkbox">EEUU
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label class="texto10">
                                                    <input value="remember-me" type="checkbox">Canadá
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 texto10 sinkinSans300L">
                                            <div class="checkbox">
                                                <label class="texto10">
                                                    <input class="" type="checkbox">
                                                    Colombia
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label class="texto10">
                                                    <input value="remember-me" type="checkbox">Brasil
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="asia">
                            <div class="panel-heading" role="tab" id="">
                                <div class="subtPais caption checkbox sinkinSans300L">
                                    <label>
                                        <input class="letra-naranja" type="checkbox">
                                        Asia
                                    </label>
                                </div>
                                <div class="tools">
                                    <a class="collapsed paddingCollapse" data-toggle="collapse" data-parent="#accordion"
                                       href="#asia" aria-expanded="true" aria-controls="collapseThree"></a>
                                </div>

                            </div>
                            <div id="asia" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingThree" aria-expanded="true" style="">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6 texto10 sinkinSans300L">
                                            <div class="checkbox">
                                                <label class="texto10">
                                                    <input value="remember-me" type="checkbox">EEUU
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label class="texto10">
                                                    <input value="remember-me" type="checkbox">Canadá
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 texto10 sinkinSans300L">
                                            <div class="checkbox">
                                                <label class="texto10">
                                                    <input class="" type="checkbox">
                                                    Colombia
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label class="texto10">
                                                    <input value="remember-me" type="checkbox">Brasil
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg_V text-uppercase">
                        <label class="colorB styleEncabezado sinkinSans300L">precios</label>
                    </div>
                    <div class="paddingFiltrar sinkinSans300L">
                        <div class="subtPais checkbox padding-top-15">
                            <label>
                                <input class="letra-naranja" type="checkbox">
                                de 0 a 19 usd
                            </label>
                        </div>
                        <div class="subtPais checkbox padding-top-15">
                            <label>
                                <input class="letra-naranja" type="checkbox">
                                de 20 a 39 usd
                            </label>
                        </div>
                        <div class="subtPais checkbox padding-top-15">
                            <label>
                                <input class="letra-naranja" type="checkbox">
                                de 40 o más usd
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!--FIN categoria y rifas-->
            <!--Contenido rifas-->
            <div class="col-xs-12 col-sm-8 col-lg-7 paddingRifas">
                <div class="row">
                    <div class="row padding-bottom20 ">
                        <div class="floatRight padding-rigth80 sinkinSans600SB hidden-xs">
                            <span class=" text-uppercase pull-left margin-right-15">ordenar por:</span>
                            <button type="button" class="btn btn-info padding0 pull-left margin-right-15"><span>%</span>
                            </button>
                            <button type="button" class="btn btn-info padding0 pull-left"><span class="ti-money"></span>
                            </button>
                        </div>
                    </div>
                    @if (count($raffles) > 0)
                        @foreach($raffles as $raffle)
                            <div class="row padding20 bg-rifas1 center-block">
                                <div class="col-xs-4 col-md-6">
                                    <div class="hidden-lg visible-xs padding-top-20 padding-left-0">
                                        <img src="{{ $raffle->image }}" class="dimenImgCarouselR"
                                             alt="">
                                    </div>
                                    <div id="myCarousel" class="carousel carouselRifas slide hidden-xs "
                                         data-ride="carousel">
                                        <!-- Indicators -->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active">
                                                <img src="{{ asset('pics/front/proyecto1.jpg') }}"
                                                     class="dimenImgCarouselR"
                                                     alt="First slide">
                                            </div>
                                            <div class="item">
                                                <img src="{{ asset('pics/front/habana2.png') }}"
                                                     class="dimenImgCarouselR"
                                                     alt="Second slide">
                                            </div>
                                        </div>
                                        <ol class="carousel-indicators">
                                            <li data-target="#myCarousel" data-slide-to="0" class=""></li>
                                            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                                            <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="col-xs-8 col-md-6 padding-top10R">
                                    <span class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">74%</span>
                                    <span class="texto14 colorN pull-left sinkinSans600SB texto14">{{ $raffle->getOwner->name }} {{ $raffle->getOwner->lastname }}</span>
                                    <span class="ti-location-pin texto16 padding-left10 colorN"></span>
                                    <!-- TODO Buscar como poner el texto al lado de la imagen sin hacerla flotar -->
                                    <span class="texto14 padding-left10 sinkinSans600SB texto14 colorN"><img class="img img-responsive img-circle" style="align-self: left" src="{{ asset('pics/countries/'. $raffle->getLocation->name .'.png') }}">{{ $raffle->getLocation->name }}</span>
                                    <h4 class=" text-uppercase sinkinSans400R textoR">
                                        <a class="colorN" href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}">{{ $raffle->title }}</a>
                                    </h4>
                                    <div class="hidden-lg texto8">
                                        <span class="sinkinSans300L ">Costo:</span>
                                        <span class="sinkinSans600SB">{{ $raffle->price }}</span>
                                    </div>
                                    <div class="costo hidden-xs">
                                        <div class="pull-left porcientoCompletado">
                                            <span class="texto35 sinkinSans600SB colorN">@if( \App\Raffle::getTicketsSold($raffle->id) > 0){{ $raffle->tickets_count / \App\Raffle::getTicketsSold($raffle->id) }} @else 0 @endif%</span><br>
                                            <span class="sinkinSans400R">completado</span>
                                        </div>
                                        <div class="pull-left padding-top-20 padding-left30">
                                            <span class="sinkinSans300L texto10">Costo:</span><br>
                                            <span class="colorN sinkinSans600SB">${{ $raffle->price }}</span>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled list-inline padding-top-20 hidden-xs pull-right">
                                        <li class=" margin-right-10">
                                            <a href="{{ route('raffles.follow',['raffleId' => $raffle->id]) }}">
                                        <span class="ti-face-smile texto-negrita colorV margin-right-5 texto16"
                                              title="Seguir"></span>
                                                <span class="colorV sinkinSans600SB">Seguir</span>
                                            </a>
                                        </li>
                                        <li class=" margin-right-10">
                                            <a href="">
                                        <span class="ti-share texto-negrita colorV margin-right-5 texto16"
                                              title="Compartir"></span>
                                                <span class="colorV sinkinSans600SB">Compartir</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <button type="button" class="btn btn-info btnSiguiente"><span
                                                        class="ti-arrow-right"></span>
                                            </button>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{ $raffles->links() }}
                    {{--<div class="row padding-top-30 text-center colorN paginado">--}}
                        {{--<div id="pagination" class="center">--}}
                            {{--<ul class="pagination sinkinSans600SB  ">--}}
                                {{--<li><a href="#"><span class="ti-angle-left"></span></a></li>--}}
                                {{--<li><a href="#">1</a></li>--}}
                                {{--<li><a href="#">2</a></li>--}}
                                {{--<li><a href="#">3</a></li>--}}

                                {{--<li><a href="#"><span class="ti-angle-right"></span></a></li>--}}
                            {{--</ul>--}}


                        {{--</div>--}}
                    {{--</div>--}}
                    <!--Fin Espacio para el paginado-->
                </div>

            </div>
            <!--FIN Contenido rifas-->
            @include('partials.frontend.promotions')
        </div>
    </div>
@stop