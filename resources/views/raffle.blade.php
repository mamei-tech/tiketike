@extends('layouts.base')
@section('content')
    @include('partials.frontend.header')
    @include('partials.front_modals.filters')
    @include('partials.front_modals.mobile_suggest')
    <div class="container margin-top60">
        <div class="row">
            <!--Contenido ticket-->
            <div class="col-xs-12 col-sm-7 col-sm-push-5 col-lg-7 col-lg-push-3 padding-top-20 paddingLeft0 padding-rigth-0">
                <div class="contenidoTicket" id="scrollContent">
                    <div class="col-xs-12">
                        <div class="col-xs-4 col-md-3">
                            <img src="{{ asset('pics/front/user.jpg') }}" alt="Ringo" class="imgUsuario sombraImgUser2">
                        </div>
                        <div class="col-xs-8 col-md-9 texto14 sinkinSans600SB padding0">
                            <span class="colorN">{{ $raffle->getOwner->name }} {{ $raffle->getOwner->lastname }}</span>
                            <span class="ti-location-pin"></span>
                            <span class=""><img class="img img-responsive img-circle" style="align-self: left" src="{{ asset('pics/countries/'. $raffle->getLocation->name .'.png') }}">{{ $raffle->getLocation->name }}</span>
                            <p class="texto18 text-uppercase texto-negrita colorN padding-top-10"
                               style="font-family: sinkinSans700Bold">{{ $raffle->title }}</p>
                        </div>
                    </div>
                    <div class="col-xs-12 ">
                        <div id="myCarousel" class="carousel carouselTicket slide" data-ride="carousel">
                            <!-- Indicators -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <img src="{{ asset('pics/front/slide1.jpg') }}" class="dimenImgCarouselTicket" alt="First slide">
                                </div>
                                <div class="item">
                                    <img src="{{ asset('pics/front/Slide2_bg.jpg') }}" class="dimenImgCarouselTicket" alt="Second slide">
                                </div>
                            </div>
                            <ol class="carousel-indicators carousel-indicatorsTicket">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-xs-12 paddingR-5">
                        <span class="italic margin-right5">Articulos:</span>
                        <strong class="colorN">1</strong>
                        <p class="colorN">{{ $raffle->description }}</p>
                    </div>
                    <div class="col-xs-12">
                        <div class="pull-left padding-top-20 links">
                            <!-- Button trigger modal Mis compras de Ticket-->
                            <a class="icon" data-toggle="modal" href="#misCompras" title="Mis Tickets">
                                <span class="ti-ticket colorV dimenIconos"></span>
                                <span class="badge badge-default">5</span>
                            </a>
                            <!-- Modal -->
                            <div class="modal fullscreen-modal fade" id="misCompras" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header padding-top-30">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h6 class="modal-title textoCenter text-uppercase sinkinSans600SB colorN">Mis
                                                Tickets
                                                comprados</h6>
                                        </div>
                                        <div class="modal-body">
                                            <div class="listadoTickets padding-left50">
                                                <ul class="nav sinkinSans400R">
                                                    <li class="padding-top-15 margin-top5 bg-prueba">
                                                    <span
                                                            class="padding-top-20 padding-left20 text-uppercase colorB margin-right-10">ASCCDDD00</span>
                                                    </li>
                                                    <li class="padding-top-15 margin-top5 bg-prueba">
                                                    <span
                                                            class="padding-top-20 padding-left20 text-uppercase colorB margin-right-10">ASCCDDD00</span>
                                                    </li>
                                                    <li class="padding-top-15 margin-top5 bg-prueba">
                                                    <span
                                                            class="padding-top-20 padding-left20 text-uppercase colorB margin-right-10">ASCCDDD00</span>
                                                    </li>
                                                    <li class="padding-top-15 margin-top5 bg-prueba">
                                                    <span
                                                            class="padding-top-20 padding-left20 text-uppercase colorB margin-right-10">ASCCDDD00</span>
                                                    </li>
                                                    <li class="padding-top-15 margin-top5 bg-prueba">
                                                    <span
                                                            class="padding-top-20 padding-left20 text-uppercase colorB margin-right-10">ASCCDDD00</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>
                        <ul class="list-unstyled pull-right list-inline padding-top-20 ">
                            <li class="margin-right-10">
                                <a href="" title="Comentarios" id="comenta">
                                    <span class="ti-comment colorV margin-right-5 dimenIconos"></span>
                                </a>
                            </li>
                            <li class="margin-right-10">
                                <a href="" title="Seguir">
                                    <span class="ti-face-smile colorV margin-right-5 dimenIconos"></span>
                                </a>
                            </li>
                            <li class="margin-right-10">
                                <a href="" title="Compartir">
                                    <span class="ti-share colorV margin-right-5 dimenIconos"></span>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div id="comentarios" style=" display:none" class="col-xs-12">
                        <strong class="colorN text-uppercase sinkinSans600SB">comentarios</strong>
                        <div class="comments">
                            <div class="media">
                                <a href="#" class="pull-left  margin-right-20">
                                    <img src="{{ asset('pics/front/user.jpg') }}" alt="Ringo" class="imgUsuario sombraImgUser2">
                                </a>
                                <div class="media-body">
                                    <div class="margin-bottom-20 sinkinSans400R texto10 ">
                                    <span class="media-heading"><span class="colorN">Usuario</span>
                                        <span class="colorN">/</span>
                                        <span class="colorN">País</span>
                                        <a href="#" class="colorV texto8 sinkinSans400I pull-right margin-right-15">responder...</a>
                                    </span>
                                        <p class="texto10 sinkinSans300L">Donec id elit non mi porta gravida at eget metus.
                                            Fusce dapibus,
                                            tellus ac cursus commodo, tortor mauris condimentum nibh,
                                            ut fermentum massa justo sit amet risus.
                                            Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                        </p>
                                    </div>
                                    <!-- Nested media object -->
                                    <div class="media">
                                        <a href="#" class="pull-left margin-right-20">
                                            <img src="{{ asset('pics/front/user2.jpg') }}" alt="Ringo" class="imgUsuario2 sombraImgUser2">
                                        </a>
                                        <div class="media-body">
                                            <div class="margin-bottom-20 sinkinSans400R texto10">
                                             <span class="media-heading"><span class="colorN">Usuario</span>
                                                 <span class="colorN">/</span>
                                                 <span class="colorN">País</span>
                                                 <a href="#"
                                                    class="colorV texto8 sinkinSans400I pull-right margin-right-15">responder...</a>
                                              </span>
                                                <p class="texto10 sinkinSans300L">Donec id elit non mi porta gravida at eget
                                                    metus. Fusce dapibus,
                                                    tellus ac cursus commodo, tortor mauris condimentum nibh,
                                                    ut fermentum massa justo sit amet risus.
                                                    Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end media-->
                                </div>
                            </div>
                            <!--end media-->
                            <div class="media">
                                <a href="#" class="pull-left margin-right-20">
                                    <img src="{{ asset('pics/front/user.jpg') }}" alt="Ringo" class="imgUsuario sombraImgUser2">
                                </a>
                                <div class="media-body">
                                    <div class="margin-bottom-20 sinkinSans400R texto10">
                                      <span class="media-heading"><span class="colorN">Usuario</span>
                                        <span class="colorN">/</span>
                                        <span class="colorN">País</span>
                                        <a href="#" class="colorV texto8 sinkinSans400I pull-right margin-right-15">responder...</a>
                                    </span>
                                        <p class="texto10 sinkinSans300L">Donec id elit non mi porta gravida at eget metus.
                                            Fusce dapibus,
                                            tellus ac cursus commodo, tortor mauris condimentum nibh,
                                            ut fermentum massa justo sit amet risus.
                                            Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--end media-->
                        </div>
                        <div class="post-comment padding-top-30">
                            <strong class="colorN sinkinSans600SB text-uppercase">comenta</strong>
                            <form role="form">
                                <div class="form-group">
                                    <textarea class="form-control bg-gris" rows="5"></textarea>
                                </div>
                                <button class="btn btn-primary bg_green extraer sinkinSans700B text-uppercase"
                                        type="submit">Enviar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--FIN Contenido ticket-->
            <div class="col-xs-12 visible-xs publicidad padding-top-20 padding-bottom20">
                <img src="{{ asset('pics/front/proyecto1.jpg') }}" class="imgPublicidadR" alt="">
            </div>
            <div class="col-xs-12 col-sm-5 col-sm-pull-7 col-lg-3 col-lg-pull-7 paddingLeft0 padding-rigth-0">
                <div class="bg-gris paddingLateralGris">
                    <div class="borderTopDashed padding-bottom20 ">
                        <div class="pull-left padding-top-10 margin-bottom-20">
                            <span class="text-uppercase dashedDerecho colorV sinkinSans700B">venta de tickets</span>
                        </div>
                        <div class="pull-left padding-left10 texto10 colorV padding-top-10">
                            <span class="sinkinSans200LI">Costo:</span>
                            <span class="sinkinSans700B colorV">20</span>
                        </div>
                    </div>
                    <div class="col-xs-12 borderBottomDashed"></div>
                    <div class="row padding-top-20 padding-left30">
                        <div class="centerM slickVertical sinkinSans400R text-uppercase  ">
                            @foreach($tickets as $ticket)
                            <div>
                                <div class="padding-top-15  bg-prueba pull-left">
                                    <span class="padding-top-20 padding-left25 text-uppercase colorB margin-right-10">{{ $ticket->code }}</span>
                                </div>
                                <div class="padding-top-30">
                                    <input class="margin-left15 " type="checkbox">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="btn btn-info btnShufle center-block "><span class="ti-control-shuffle"></span>
                    </div>
                    <div class="borderTopDashed padding-bottom20">
                        <div class="pull-left">
                            <strong class="sinkinSans600SB colorV texto24 pull-left margin-right-10">24</strong>
                            <div class="pull-left colorV texto8 sinkinSans300LI padding-top5">
                                <span>Tikects</span><br>
                                <span> Seleccionados</span>
                            </div>
                        </div>
                        <div class="pull-right colorV padding-top-10">
                            <button type="button"
                                    class="btn btn-primary bg_green extraer sinkinSans700B text-uppercase">Comprar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bottomLIzquierdo"></div>
            </div>

            @include('partials.frontend.promotions')

        </div>
    </div>
@stop
@section('additional_scripts')
    <script>


        $('#comenta').click(function (e) {
            e.preventDefault();
            $('#comentarios').fadeIn("300");
        });

        $('.slickVertical').slick({
            autoplay: true,
            vertical: true,
            verticalSwiping: true,
            slidesToShow: 2,
            slidesToScroll: 4,
            arrows: false,
            swipeToSlide: true,
            infinite: true,
            draggable: true,
            centerMode: true,
            centerPadding: '50%',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 3
                    }
                }
            ]
        });


    </script>
@stop