<div id="navheaderdiv-leftcolum" class="navbar-header">
    <button id="responsive-btn" class="navbar-toggle collapsed" type="button" data-toggle="collapse"
            data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <a href="{{ route('main') }}" class="padding-left">
        <img src="{{ asset('pics/front/logoPeque.svg') }}" class="navbar-log" alt="">
    </a>

    <img class="styleBorderL padding-left30 hidden-xs" src="{{ asset('pics/front/borderLeft.svg') }}" alt="">

</div>

<nav id="main-menu" class="navbar-collapse bs-navbar-collapse collapse" role="navigation">

    <div class="col-md-5">
        <ul class="nav navbar-nav">
            <li>
                <a href="{{ route('raffles.index') }}" class="text-uppercase colorB sinkinSans300L icon">
                    <span class="ti-ticket  margin-right5 rotar  texto16"></span>Rifas
                </a>
            </li>
            <li>
                <a href="" class="text-uppercase colorB sinkinSans300L icon">
                    <span class="ti-comments margin-right5 texto16 "></span>Chat
                </a>
            </li>
        </ul>
    </div>

    <div id="navdiv-rightcolum" class="col-md-5">
        <ul class="nav navbar-nav">
            {{-- Right --}}
            @if(\Auth::user() != null)
                <li class="">
                    <a id="logged-user-name" href="{{route('profile.info',['userid'=> \Auth::User()->id])}}"
                       class="colorB sinkinSans300L"> {{\Auth::User()->name}} <img src="{{ Auth::user()->getMedia('avatars')->first()->getUrl() }}"

                                                                                   alt="Ringo"
                                                                                   class="imgUsuarioMenu sombraImgUserMenu margin-left5"></a>
                </li>
            @endif
            <li class="notifica">
                <a class="text-uppercase colorB icon" data-toggle="modal" href="#notificaciones" title="Notificaciones">
                    <span class="ti-bell texto20"></span>
                    <span class="badge badge-default">
					7 </span>
                </a>

            @include('partials.front_modals.notification_modal')

            <li class="hidden-xs"><img class="styleBorderL colorB" src="{{ asset('pics/front/borderLeft.svg') }}" alt="">
            </li>
            <li class="hidden-xs"><a href="" class="icon"><img class="stylebandera" src="{{ asset('pics/front/ban2.jpg') }}"
                                                               alt=""></a></li>
            <li class="hidden-xs colorB">
                <a href="#" class="icon colorB"><span class="ti-search texto20 search-btn show-search-icon"></span></a>
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
    </div>

</nav>

