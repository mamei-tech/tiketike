@extends('layouts.base')
@section('content')
    @include('partials.frontend.header')
    @include('partials.front_modals.filters')
    @include('partials.front_modals.mobile_suggest')
    @include('partials.front_modals.notification_modal')
    <div class="container contenido">
        <div class="row ">
            <!--categoria y rifas-->
            <div class="col-sm-4 col-lg-3 hidden-xs padding-rigth-0">
                <div class="categoria">
                    <div class="listadoCategoriaN">
                        <h4 class="text-uppercase sinkinSans600SB colorV">categorías</h4>
                        <ul class="nav sinkinSans400R">
                            <li class="active"><a href="#" class="colorN text-uppercase" id="all">Todos</a></li>
                            @foreach($categories as $category)
                                <li><a href="#" id="{{ $category->category }}"
                                       class="colorN text-uppercase filters">{{$category->category}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="filtrarpor">
                    <h4 class="text-uppercase sinkinSans600SB colorV">filtrar por</h4>
                    <div class="bg_V text-uppercase">
                        <label class="colorB styleEncabezado sinkinSans300L">paises</label>
                    </div>
                    <div class="paddingFiltrar">
                        <div class="text-uppercase margin-bottom-20">
                            <label class="colorN styleEncabezado sinkinSans300L">Seleccione uno o varios países</label>
                            <select class="select2 margin-bottom-20" name="filterByCountry" id="filterByCountry"
                                    multiple="multiple" style="width: 100%"> <!-- TODO llevar el estilo este a css -->
                                <option disabled>Seleccione uno o varios paises</option>
                                @foreach($countries as $country)
                                    <option id="{{ $country->name }}"
                                            value="{{ $country->name }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
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
                            <button id="percent" type="button" class="btn btn-info padding0 pull-left margin-right-15">
                                <span>%</span>
                            </button>
                            <button id="price" type="button" class="btn btn-info padding0 pull-left"><span
                                        class="ti-money"></span>
                            </button>
                        </div>
                    </div>
                    <div class="row rafflescontent" style="overflow-y: scroll; overflow-x: hidden; height: 588.533px">
                        @if (count($raffles) > 0)
                            @foreach($raffles as $raffle)
                                <div class="row padding20 bg-rifas1 center-block {{$raffle->id}}">
                                    <div class="col-xs-4 col-md-6">
                                        <div class="hidden-lg visible-xs padding-top-20 padding-left-0">
                                            <img src="@if(count($raffle->getMedia('raffles')) > 0){{ $raffle->getMedia('raffles')->first()->getUrl() }} @endif"
                                                 class="dimenImgCarouselR"
                                                 alt="">
                                        </div>
                                        <div id="myCarousel{{ $raffle->id }}"
                                             class="carousel carouselRifas slide hidden-xs "
                                             data-ride="carousel">
                                            <!-- Indicators -->
                                            <div class="carousel-inner" role="listbox">
                                                <?php $count = 0;?>
                                                @foreach($raffle->getMedia('raffles') as $media)
                                                    <div class="item @if($count == 0) active @endif">
                                                        <img src="{{ $media->getUrl() }}"
                                                             class="dimenImgCarouselR"
                                                             alt="First slide">
                                                    </div>
                                                    <?php $count++; ?>
                                                @endforeach
                                            </div>
                                            <?php $count = 0; ?>
                                            <ol class="carousel-indicators">
                                                @while($count < count($raffle->getMedia('raffles')))
                                                    <li data-target="#myCarousel{{ $raffle->id }}"
                                                        data-slide-to="{{ $count }}"
                                                        class="@if($count == 0) active @endif"></li>
                                                    <?php $count++; ?>
                                                @endwhile
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="col-xs-8 col-md-6 padding-top10R">
                                        <span class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">{{ $raffle->getProgress() }}
                                            %</span>
                                        <span class="texto14 colorN pull-left sinkinSans600SB texto14">{{ $raffle->getOwner->name }} {{ $raffle->getOwner->lastname }}</span>
                                        <span class="ti-location-pin texto16 padding-left10 colorN"></span>
                                        <!-- TODO Buscar como poner el texto al lado de la imagen sin hacerla flotar -->
                                        <span class="texto14 padding-left10 sinkinSans600SB texto14 colorN"><img class="flag-country" src="{{ asset('pics/countries/png100px/'.$raffle->getLocation->code.'.png') }}">{{ $raffle->getLocation->name }}</span>
                                        <h4 class=" text-uppercase sinkinSans400R textoR">
                                            <a class="colorN"
                                               href="{{ route('raffle.tickets.available',['raffleId' => $raffle->id]) }}">{{ $raffle->title }}</a>
                                        </h4>
                                        <div class="hidden-lg texto8">
                                            <span class="sinkinSans300L ">Costo:</span>
                                            <span class="sinkinSans600SB">{{ $raffle->price }}</span>
                                        </div>
                                        <div class="costo hidden-xs">
                                            <div class="pull-left porcientoCompletado">
                                                <span class="texto35 sinkinSans600SB colorN">{{ round($raffle->getProgress()) }}
                                                    %</span><br>
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
                                        <span data-toggle="modal" data-target="#{{$raffle->id}}-share_modal" class="ti-share texto-negrita colorV margin-right-5 texto16"
                                              title="Compartir"></span>
                                                    <span class="colorV sinkinSans600SB">Compartir</span>
                                                </a>
                                            </li>
                                            @include('partials.front_modals.share_modal')
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
                    </div>
                    <div class="col-md-12 text-center">
                        {{ $raffles->links() }}
                    </div>
                </div>
            </div>
            <!--FIN Contenido rifas-->
            @include('partials.frontend.promotions',['suggested' => $suggested])
        </div>
    </div>
@stop

@section('footerScripts')
    @parent
    <script src="{{ asset('js/raffles.min.js') }}" defer></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
