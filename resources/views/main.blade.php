@extends('layouts.base')
@section('content')
    <section class="bienvenidos">
        <div class="container ">
            <div class="row">
                <div class="col-sm-7 col-md-4 col-lg-9">
                    <div class="logo padding-left65">
                        <img src="{{ asset('pics/front/logo.svg') }}" class="img-responsive" alt="Logo tikeTike">
                    </div>
                </div>
                <div class="col-sm-5 col-md-4 col-lg-3 hidden-xs">
                    <ul class="list-inline padding-top-20">
                        <li class="margin-right-20 ">
                            <a data-toggle="modal" href="#myModal2" title="Registrarse"
                               class="colorB texto16 sinkinSans500M">Regístrate</a>
                        </li>
                        <li class="margin-left-20 ">
                            <a data-toggle="modal" href="#myModal" title="Autenticarse"
                               class="colorB texto16 sinkinSans500M">Autenticarse</a>
                            <!-- Modal-->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header form-signin padding-left-0">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                <span class="ti-angle-right"></span>
                                            </button>
                                            <ul class="list-unstyled list-inline pull-right">
                                                <li><a href="rifas.php" class="text-uppercase colorN" title="Rifas"><span
                                                                class="ti-ticket dimenIconos padding-left10"></span></a>
                                                </li>
                                                <li class="borderLeft"><a href="" class="text-uppercase colorN"
                                                                          title="Rifas"><span
                                                                class="ti-comments dimenIconos padding-left10 margin-right5"></span></a>
                                                </li>
                                                <li class=""><img class="dimenBandera padding-left10" src="{{ asset('pics/front/ban2.jpg') }}"
                                                                  alt=""></li>
                                                <li class="colorN">
                                                    <a href="#" class="icon" title="Buscar"><span
                                                                class="ti-search dimenIconos search-btn show-search-icon colorN padding-left10"></span></a>
                                                    <div class="search-box" style="display: none;">
                                                        <form action="#">
                                                            <div class="input-group">
                                                                <input placeholder="Search" class="form-control"
                                                                       type="text">
                                                                <span class="input-group-btn">
                                    <button class="btn btn-search btn-primary" type="submit">Search</button>
                                </span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12 "></div>
                                            <h5 class="modal-title text-uppercase textoCenter padding-top-20">Inicio de
                                                sesión</h5>
                                            <form class="form-signin">
                                                <label for="selector" class="colorN italic">Nombre</label>
                                                <input type="email" class="form-control form-control-new " id="inputEm">
                                                <label for="selector"
                                                       class="colorN italic padding-top-20">Contraseña</label>
                                                <input type="password" class="form-control form-control-new "
                                                       id="inputPassword">
                                                <div class="row padding-top-20">
                                                    <div class="col-xs-7">
                                                        <a href="#" class="texto16"><span
                                                                    class="italic colorGreen floatRight">Regístrate</span></a>
                                                    </div>
                                                    <div class="col-xs-5">
                                                        <a type="submit" class="btn btn-sm btn-primary btn-block">
                                                            Entrar</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        </li>
                    </ul>

                </div>
            </div>
            <div class="row padding-left65">
                <div class="col-md-9 padding-top-20 center-textR">
                    <p class="colorB textoBienv ">Texto de bienvenida del sitio
                        y de orientación al usuario</p>
                    <span class="colorB texto24 sinkinSans300LI">Texto de bienvenida del sitio y de orientación al usuario</span>
                </div>
                <div class="col-md-3 padding-top-20 center-textR">
                    <a href="#" class="btn btn-primary btn-lg texto24 bg_green padding10">
                        <span class="margin-right-15 padding-left10 sinkinSans300L">Crear rifa</span>
                        <span aria-hidden="true" class="ti-angle-right styleFlechaD"></span>
                    </a>
                    <div class="padding-top50 margin-left15">
                        <a href="#" class="texto24 colorB padding10">
                            <span class="margin-right-15 sinkinSans300L">Participa</span>
                            <i aria-hidden="true" class="ti-angle-right styleFlechaD"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 margin-bottom-30 padding-top-10">
                <div class="flecha-bajar text-center">
                    <a data-scroll="" href="#menu"><img src="{{ asset('pics/front/flecha-bajar.png') }}" class="dimenFlechaBajar"
                                                        alt=""></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Promo slider principal -->
    <div class="promo-block" id="promo-block">
        <div class="tp-banner-container">
            <div class="tp-banner">
                <ul>
                    <li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-delay="9400"
                        class="slider-item-1">
                        <img src="{{ asset('pics/front/slide1.jpg') }}" alt="" data-bgfit="cover" style="opacity:0.4 !important;"
                             data-bgposition="center center" data-bgrepeat="no-repeat">
                        <div class="tp-caption large_text customin customout start"
                             data-x="center"
                             data-hoffset="0"
                             data-y="center"
                             data-voffset="140"
                             data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                             data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                             data-speed="1000"
                             data-start="500"
                             data-easing="Back.easeInOut"
                             data-endspeed="300">
                        </div>
                        <div class="tp-caption large_bold_white fade"
                             data-x="center"
                             data-y="center"
                             data-voffset="-10"
                             data-speed="300"
                             data-start="1700"
                             data-easing="Power4.easeOut"
                             data-endspeed="500"
                             data-endeasing="Power1.easeIn"
                             data-captionhidden="off"
                             style="z-index: 6">
                        </div>
                    </li>
                    <li data-transition="fadefromright" data-slotamount="5" data-masterspeed="700" data-delay="9400"
                        class="slider-item-2">
                        <img src="{{ asset('pics/front/slide2.jpg') }}" alt="slidebg2" data-bgfit="cover" data-bgposition="center center"
                             data-bgrepeat="no-repeat">
                        <div class="tp-caption large_bold_white fade"
                             data-x="center"
                             data-y="center"
                             data-voffset="-10"
                             data-speed="300"
                             data-start="1700"
                             data-easing="Power4.easeOut"
                             data-endspeed="500"
                             data-endeasing="Power1.easeIn"
                             data-captionhidden="off"
                             style="z-index: 6">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Promo block END -->
    <!--menu-->
    <div id="menu" class="navbar-inverse bg_menu header ">
        <div class="container ">
            @include('partials.frontend.content_menu')
        </div>
        <div class="morado-bottom"></div>
    </div>
    <!--fin menu-->
    <!--Rifas por culminas-->
    <section class="rifasporculminar padding-top-60 padding-bottom20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="borderBotDis dimenBorderBotDisc">
                        <h3 class="text-uppercase sinkinSans600SB texto24 text-center colorVC">rifas por culminar</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="slicklanding">
                        @foreach($raffles as $raffle)
                        <div class="paddingImgCarousel itemImg">
                            <img src="{{ asset('pics/front/habana2.png') }}" class="dimenImgCarousel" alt="Owl Image"/>
                            <a class="valign-center" href="#">
                                <div class="imginline"
                                     style="position: absolute; top: 45%; margin-top: -55.5px;  height: 81px;">
                                    <strong class="padding-top-10 sinkinSans600SB text-center"><span
                                                class=" texto16">@if( \App\Raffle::getTicketsSold($raffle->id) > 0){{ $raffle->tickets_count / \App\Raffle::getTicketsSold($raffle->id) }} @else 0 @endif%</span><br>{{ $raffle->title }}
                                    </strong>
                                </div>
                            </a>
                            <div class="porciento">
                                <div class=" text-center">
                                <span class="chartB chart-porcientoB" data-percent="80">
                                    <span class="percentB">80%</span>
                                </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Fin Rifas por culminas-->
    <!--usuariosTop-->
    <div class="topUsuariosTop"></div>
    <section class="usuariostop">
        <div class="container">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="co-xs-12 col-sm-4 col-md-5 col-lg-5">
                    <div class="row padding-top-30 centerR">
                        <div class="col-xs-12 col-md-1 padding-left-0 center-block">
                            <span class="ti-crown texto35 colorB"></span>
                        </div>
                        <div class="col-xs-12 col-md-10 paddingUserTop  centerR">
                            <span class="text-uppercase colorB sinkinSans600SB texto35">usuarios top</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 padding-left-0">
                            <p class="colorB texto24 sinkinSans300LI padding-top-20 centerR">Estás viendo el Top 10 de los
                                usuarios más destacados
                                del sitio
                            </p>
                        </div>
                        <div class="col-md-12 borderBotDis hidden-xs"></div>
                    </div>
                    <!--TOP de ganadores visibles solo en vista movil-->
                    <div class="col-xs-12 paddingLeft0 padding-rigth-0 visible-xs padding-top-20">
                        <div class="col-xs-4 ">
                            <div class="img-contenedor padding-bottom5">
                                <img src="{{ asset('pics/front/user.jpg') }}" alt="Ringo" class="dimenUsuarioG sombraImgUser img-popover">
                            </div>
                            <span class="text-center sinkinSans600SB texto14 padding-left10">1ro</span>
                        </div>
                        <div class="col-xs-4">
                            <div class="img-contenedor padding-bottom5">
                                <img src="{{ asset('pics/front/user.jpg') }}" alt="Ringo" class="dimenUsuarioG sombraImgUser img-popover">
                            </div>
                            <span class="text-center sinkinSans600SB texto14 padding-left10">2do</span>
                        </div>
                        <div class="col-xs-4 ">
                            <div class="img-contenedor padding-bottom5">
                                <img src="{{ asset('pics/front/user.jpg') }}" alt="Ringo" class="dimenUsuarioG sombraImgUser img-popover">
                            </div>
                            <span class="text-center sinkinSans600SB texto14 padding-left10">3ro</span>
                        </div>
                    </div>
                    <div class="col-xs-12 bg-popover visible-xs">
                        <div class="colorV visible-xs text-center texto14 padding-top-30"><span
                                    class="sinkinSans600SB text-uppercase">Jane Doe /</span> <span class="sinkinSans300LI">Pais</span>
                        </div>
                        <div class="col-xs-12 padding-top-20 sinkinSans400R">
                            <span class="colorN padding-top-20 margin-right40">Rifas ganadas:</span>
                            <strong class="colorV">20%</strong>
                            <div class="padding-top-20">
                                <span class='colorN margin-right40'>Rifas Creadas:</span>
                                <strong class="colorV">20%</strong><br>
                            </div>
                        </div>
                        <div class="col-xs-12 padding-top-20 sinkinSans400R">
                            <span class="colorN padding-top-20 margin-right40">Rifas Compartidas:</span>
                            <strong class="colorV">20%</strong>
                            <div class="padding-top-20">
                                <span class='colorN margin-right40'>Rifas Creadas:</span>
                                <strong class="colorV">20%</strong><br>
                            </div>
                        </div>
                        <a href="" class="floatRight sinkinSans200LI padding-top-30 colorN">ir al perfil
                            <span class="ti-angle-right texto16 colorN texto-negrita padding-top5"></span></a>
                    </div>
                    <!--FIN top de ganadores visibles solo en vista movil-->
                    <!--Usuarios Opinan-->
                    <div class="col-xs-12 userOpinan marginResponsive-5 padding-top-10 padding-left0">
                        <h4 class="text-uppercase padding-top-20 sinkinSans600SB texto18 centerR">los Ganadores
                            opinan</h4>
                        <div class="col-md-12 borderBotDis hidden-lg"></div>
                        <div class="row padding-top-20">
                            <div class="col-xs-4 col-sm-5 col-md-3">
                                <img src="{{ asset('pics/front/user.jpg') }}" class="dimenUsuario margin-right-20 sombraImgUser pull-left"
                                     alt="usuario">
                            </div>
                            <div class="col-xs-8 col-sm-7 col-md-9 padding-left-0">
                                <span class="pais sinkinSans400I texto14">Usuario / Pais</span><br>
                                <span class="sinkinSans200LI texto14">Yo opino que todo fue legal y que el sitio está muy bueno porque
                                todo esta muy bien
                                hecho bla bla bla.</span>
                            </div>
                        </div>
                        <div class="col-md-12 borderBotDis hidden-lg"></div>
                        <div class="row padding-top-20">
                            <div class="col-xs-4 col-sm-5 col-md-3">
                                <img src="{{ asset('pics/front/user2.jpg') }}" class="dimenUsuario margin-right-20 sombraImgUser pull-left"
                                     alt="usuario">
                            </div>
                            <div class="col-xs-8 col-sm-7 col-md-9 padding-left-0">
                                <span class="pais sinkinSans400I texto14">Usuario / Pais</span><br>
                                <span class="sinkinSans200LI texto14">Yo opino que todo fue legal y que el sitio está muy bueno porque
                                todo esta muy bien
                                hecho bla bla bla.</span>
                            </div>
                        </div>
                        <div class="col-md-12 borderBotDis hidden-lg"></div>
                        <a href="#" class="colorV pull-right padding-top-10 sinkinSans600SB">Ver más</a>
                    </div>
                    <!--FIN Usuarios Opinan-->
                </div>
                <!--TOP usuarios ganadores solo visible en desktop-->
                <div class="col-sm-3 col-md-3 col-lg-2 user padding-top-20 hidden-xs ">
                    <div class="information padding-top-20">
                        <div class="pull-left margin-right-15">
                            <div class="img-contenedor">
                                <img src="{{ asset('pics/front/user.jpg') }}" alt="Ringo" class="dimenUsuarioG sombraImgUser">
                            </div>
                        </div>
                        <div class="pull-left padding-top-10">
                            <h3 class="sinkinSans600SB">1ro</h3>
                        </div>
                    </div>
                    <div class="information padding-top-40">
                        <div class="pull-left margin-right-15">
                            <div class="img-contenedor">
                                <img src="{{ asset('pics/front/user.jpg') }}" alt="Ringo" class="dimenUsuarioG sombraImgUser">
                            </div>
                        </div>
                        <div class="pull-left padding-top-10">
                            <h3 class="sinkinSans600SB">2do</h3>
                        </div>
                    </div>
                    <div class="information padding-top-40">
                        <div class="pull-left margin-right-15">
                            <div class="img-contenedor">
                                <img src="{{ asset('pics/front/user.jpg') }}" alt="Ringo" class="dimenUsuarioG sombraImgUser">
                            </div>
                        </div>
                        <div class="pull-left padding-top-10">
                            <h3 class="sinkinSans600SB">3ro</h3>
                        </div>
                    </div>

                </div>
                <div class="col-sm-5 col-md-4 col-lg-4 bg-popoverLanding padding-top-50 hidden-xs padding-left-0">
                    <span class="colorV text-uppercase sinkinSans600SB texto24">Jane Doe</span><br>
                    <span class="colorV sinkinSans300LI texto20">Pais</span><br>
                    <div class="row sinkinSans200L texto14 padding-top-20 paddingLeft0">
                        <div class="col-xs-12 padding-top-20 paddingLeft0">
                            <div class="col-xs-9"><span class="colorN margin-right-20">Rifas creadas:</span></div>
                            <div class="col-xs-3"><strong class="colorV sinkinSans600SB">20%</strong><br></div>
                        </div>
                        <div class="col-xs-12 padding-top-20 paddingLeft0">
                            <div class="col-xs-9"><span class="colorN margin-right-20">Rifas ganadas:</span></div>
                            <div class="col-xs-3"><strong class="colorV sinkinSans600SB">100%</strong><br></div>
                        </div>
                        <div class="col-xs-12 padding-top-20 paddingLeft0">
                            <div class="col-xs-9"><span class="colorN margin-right-20">Rifas compartidas:</span></div>
                            <div class="col-xs-3"><strong class="colorV sinkinSans600SB">20%</strong><br></div>
                        </div>
                        <div class="col-xs-12 padding-top-20 paddingLeft0">
                            <div class="col-xs-9"><span class="colorN margin-right-20">Tickets vendidos:</span></div>
                            <div class="col-xs-3"><strong class="colorV sinkinSans600SB">20%</strong><br></div>
                        </div>
                    </div>
                    <a href="" class="floatRight sinkinSans200LI padding-top-50 colorN">ir al perfil
                        <span class="ti-angle-right texto16 colorN texto-negrita padding-top5"></span></a>
                </div>
            </div>
            <!--FIN TOP usuarios ganadores solo visible en desktop-->
        </div>
    </section>

    <div class="bottomUsuariosTop"></div>
@stop