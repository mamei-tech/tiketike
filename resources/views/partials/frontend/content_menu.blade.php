<div class="navbar-header">
    <button id="responsive-btn" class="navbar-toggle collapsed" type="button" data-toggle="collapse"
            data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a href="{{ route('main') }}" class="padding-left"><img src="{{ asset('pics/front/logoPeque.svg') }}"
                                                            class="dimenLogoPeque"
                                                            alt=""></a>
    <img class="styleBorderL padding-left30 hidden-xs" src="{{ asset('pics/front/borderLeft.svg') }}" alt="">
</div>
<nav id="main-menu" class="navbar-collapse bs-navbar-collapse collapse" role="navigation">
    <ul class="nav navbar-nav ">
        <li><a href="{{ route('raffles.index') }}" class="text-uppercase colorB sinkinSans300L icon"><span
                        class="ti-ticket  margin-right5 rotar  texto16"></span>Rifas</a></li>
        <li><a href="" class="text-uppercase colorB sinkinSans300L icon"><span
                        class="ti-comments margin-right5 texto16 "></span>Chat</a></li>
        @if(\Auth::user() != null)
            <li class="active padding-left650">
                <a href="{{route('profile.info',['userid'=> \Auth::User()->id])}}"
                   class="colorB sinkinSans300L"> {{\Auth::User()->name}} <img src="{{ asset('pics/front/user.jpg') }}"
                                                                               alt="Ringo"
                                                                               class="imgUsuarioMenu sombraImgUserMenu margin-left5"></a>
            </li>
        @endif
        <li class="notifica">
            <a class="text-uppercase colorB icon" data-toggle="modal" href="#notificaciones" title="Notificaciones">
                <span class="ti-bell texto20"></span>
                <span class="badge badge-default">
					7 </span></a>
            <!-- Modal -->
            <div class="modal fade" id="notificaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header form-signin padding-left-0 padding-bottom20">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <span class="ti-angle-right"></span>
                            </button>
                            <ul class="list-unstyled list-inline pull-right">
                                <li><a href="{{ route('raffles.index') }}" class="text-uppercase colorN" title="Rifas"><span
                                                class="ti-ticket dimenIconos padding-left10"></span></a>
                                </li>
                                <li class=""><img class="dimenBandera padding-left10"
                                                  src="{{ asset('pics/front/ban2.jpg') }}"
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
                            <div class="text-center">
                                <img src="{{ asset('pics/front/user.jpg') }}" alt="Ringo"
                                     class="imgUsuario sombraImgUser2"><br>
                                <div class="padding-top-10">
                                    <span class="sinkinSans300L colorN margin-right-15 padding-top5">Jane Doe</span><br>
                                    <span class="sinkinSans200LI texto10">Pais</span>
                                </div>
                            </div>
                            <div class="borderBottomG padding-top-40">
                                <span class="text-uppercase sinkinSans400R">notificaciones</span>
                                <div>
                                    <strong></strong>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </li>
        <li class="hidden-xs"><img class="styleBorderL colorB" src="{{ asset('pics/front/borderLeft.svg') }}" alt="">
        </li>
        <li class="hidden-xs"><a href="" class="icon"><img class="stylebandera" src="{{ asset('pics/front/ban2.jpg') }}"
                                                           alt=""></a></li>
        <li class="hidden-xs colorB">
            <a href="#" class="icon"><span class="ti-search texto20 search-btn show-search-icon"></span></a>
            <div class="search-box" style="display: none;">
                <form action="#">
                    <div class="input-group">
                        <input placeholder="Search" class="form-control" type="text">
                        <span class="input-group-btn">
                                    <button class="btn btn-search btn-primary" type="submit">Search</button>
                                </span>
                    </div>
                </form>
            </div>
        </li>
    </ul>
</nav>