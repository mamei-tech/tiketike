
<div class="topUsuariosTop"></div>
<section class="usuariostop">
    <div class="container">
        <div class="row dimenBorderBotDisc">
            <div class="co-xs-12 col-sm-4 col-md-5 col-lg-5 margin-right-4percent">
                <div class="row padding-top-30 centerR">
                    <div class="col-xs-12 col-md-1 padding-left-0 center-block">
                        <span class="ti-crown texto35 colorB"></span>
                    </div>
                    <div class="col-xs-12 col-md-10 paddingUserTop  centerR">
                        <span class="text-uppercase colorB sinkinSans600SB texto35">@lang('views.top_users')</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 padding-left-0">
                        <p class="colorB texto24 sinkinSans300LI padding-top-20 centerR">@lang('views.top_ten_explanation')
                        </p>
                    </div>
                    <div class="col-md-12 borderBotDis hidden-xs"></div>
                </div>
                <!--TOP de ganadores visibles solo en vista movil-->
                <div class="col-xs-12 paddingLeft0 padding-rigth-0 visible-xs padding-top-20">

                    <div class="col-xs-4 ">
                        <div class="img-contenedor padding-bottom5">
                            <img src="{{ asset('pics/front/user.jpg') }}" alt="Ringo"
                                 class="dimenUsuarioG sombraImgUser img-popover">
                        </div>
                        <span class="text-center sinkinSans600SB texto14 padding-left10">1ro</span>
                    </div>
                    <div class="col-xs-4">
                        <div class="img-contenedor padding-bottom5">
                            <img src="{{ asset('pics/front/user.jpg') }}" alt="Ringo"
                                 class="dimenUsuarioG sombraImgUser img-popover">
                        </div>
                        <span class="text-center sinkinSans600SB texto14 padding-left10">2do</span>
                    </div>
                    <div class="col-xs-4 ">
                        <div class="img-contenedor padding-bottom5">
                            <img src="{{ asset('pics/front/user.jpg') }}" alt="Ringo"
                                 class="dimenUsuarioG sombraImgUser img-popover">
                        </div>
                        <span class="text-center sinkinSans600SB texto14 padding-left10">3ro</span>
                    </div>
                </div>
                <div class="col-xs-12 bg-popover visible-xs">
                    <div class="colorV visible-xs text-center texto14 padding-top-30"><span
                                class="sinkinSans600SB text-uppercase">Jane Doe /</span> <span
                                class="sinkinSans300LI">@lang('views.country')</span>
                    </div>
                    <div class="col-xs-12 padding-top-20 sinkinSans400R">
                        <span class="colorN padding-top-20 margin-right40">@lang('views.winned_raffles'):</span>
                        <strong class="colorV">20%</strong>
                        <div class="padding-top-20">
                            <span class='colorN margin-right40'>@lang('views.created_raffles'):</span>
                            <strong class="colorV">20%</strong><br>
                        </div>
                    </div>
                    <div class="col-xs-12 padding-top-20 sinkinSans400R">
                        <span class="colorN padding-top-20 margin-right40">@lang('views.shared_raffles'):</span>
                        <strong class="colorV">20%</strong>
                        <div class="padding-top-20">
                            <span class='colorN margin-right40'>@lang('views.sold_tickets'):</span>
                            <strong class="colorV">20%</strong><br>
                        </div>
                    </div>
                    <a href="" class="floatRight sinkinSans200LI padding-top-30 colorN">@lang('views.go_to_profile')
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
                            <img src="{{ asset('pics/front/user.jpg') }}"
                                 class="dimenUsuario margin-right-20 sombraImgUser pull-left"
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
                            <img src="{{ asset('pics/front/user2.jpg') }}"
                                 class="dimenUsuario margin-right-20 sombraImgUser pull-left"
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

            <div class=" slick-vertical col-sm-3 col-md-4 col-lg-3 user hidden-xs ">
                <?php
                $count = 1;
                ?>
                @foreach($top_users as $top_user)

                    <div class="slick-list information " id="{{$top_user->id}}" style="padding-top: 20px ; padding-bottom: 20px">
                        <div class="pull-left margin-right-15 padding-left-top-users">
                            <div class="img-contenedor">
                                <img src="{{$top_user->getMedia('avatars')->first()->getUrl()}}" alt="Ringo"
                                     class="dimenUsuarioG sombraImgUser">
                            </div>
                        </div>
                        <div class="pull-left padding-top-10">
                            <h3 class="sinkinSans600SB">{{ $count.trans('views.'.$count) }}</h3>
                        </div>
                    </div>
                    <?php $count++; ?>
                @endforeach

            </div>
            <div class="col-sm-5 col-md-4 col-lg-4 bg-popoverLanding padding-top-50 hidden-xs padding-left-0">
                <span class="colorV text-uppercase sinkinSans600SB texto20" id="name">Jane Doe</span><br>
                <span class="colorV sinkinSans300LI texto20"id="country">@lang('views.country')</span><br>
                <div class="row sinkinSans200L texto14 padding-top-20 paddingLeft0">
                    <div class="col-xs-12 padding-top-20 paddingLeft0">
                        <div class="col-xs-9"><span class="colorN margin-right-20">@lang('views.created_raffles'):</span></div>
                        <div class="col-xs-3"><strong class="colorV sinkinSans600SB" id="created_raffles">20%</strong><br></div>
                    </div>
                    <div class="col-xs-12 padding-top-20 paddingLeft0">
                        <div class="col-xs-9"><span class="colorN margin-right-20">@lang('views.winned_raffles'):</span></div>
                        <div class="col-xs-3"><strong class="colorV sinkinSans600SB" id="winned_raffles">100%</strong><br></div>
                    </div>
                    <div class="col-xs-12 padding-top-20 paddingLeft0">
                        <div class="col-xs-9"><span class="colorN margin-right-20">@lang('views.shared_raffles'):</span></div>
                        <div class="col-xs-3"><strong class="colorV sinkinSans600SB">20%</strong><br></div>
                    </div>
                    <div class="col-xs-12 padding-top-20 paddingLeft0">
                        <div class="col-xs-9"><span class="colorN margin-right-20">@lang('views.sold_tickets'):</span></div>
                        <div class="col-xs-3"><strong class="colorV sinkinSans600SB" id="sold_tickets">20%</strong><br></div>
                    </div>
                </div>
                <a href="" class="floatRight sinkinSans200LI padding-top-50 colorN" id="link_to_profile">@lang('views.go_to_profile')
                    <span class="ti-angle-right texto16 colorN texto-negrita padding-top5"></span></a>
            </div>
        </div>
        <!--FIN TOP usuarios ganadores solo visible en desktop-->
    </div>
</section>

<div class="bottomUsuariosTop"></div>
