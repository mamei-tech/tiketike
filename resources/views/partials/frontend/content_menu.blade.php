<div id="navheaderdiv-leftcolum" class="navbar-header">
    <button id="responsive-btn" class="navbar-toggle collapsed" type="button" data-toggle="collapse"
            data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <a href="{{ route('main') }}" class="padding-left">
        <img src="{{ asset('pics/front/logonv.png') }}" class="navbar-log" alt="">
    </a>

    <img class="styleBorderL padding-left30 hidden-xs" src="{{ asset('pics/front/borderLeft.svg') }}" style="padding-left: 30px" alt="">

</div>

<nav id="main-menu" class="navbar-collapse bs-navbar-collapse collapse" role="navigation">

    <div class="col-md-5">
        <ul class="nav navbar-nav">
            <li>
                <a href="{{ route('raffles.index') }}" class="text-uppercase colorB sinkinSans300L icon">
                    <span class="ti-ticket  margin-right5 rotar  texto16"></span>@lang('views.raffles')
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
                       class="colorB sinkinSans300L"> {{\Auth::User()->name}} <img
                                src="{{ Auth::user()->getMedia('avatars')->first()->getUrl() }}"

                                alt="Ringo"
                                class="imgUsuarioMenu sombraImgUserMenu margin-left5"></a>
                </li>
            @endif
            @if(\Auth::user() != null)
                <li class="notifica">
                    <a class="text-uppercase colorB sinkinSans300L icon" data-toggle="modal" href="#notificaciones"
                       title="Notificaciones">
                        <span class="ti-bell texto20"></span>
                        <span class="badge badge-default"
                              id="notifications_count">{!! count(\Auth::user()->unreadNotifications) !!}</span>
                    </a>
                </li>
            @endif
            <li class="hidden-xs"><img class="styleBorderL colorB" src="{{ asset('pics/front/borderLeft.svg') }}"
                                       alt="">
            </li>
            <li class="text-center">
                <form action="{{ route('admin.lansw') }}" method="post">
                    {{ csrf_field() }}
                    <button style="background: transparent;border: transparent" type="submit" class="text-uppercase colorB padding-top-20 sinkinSans300L icon">
                        <?php
                        $currentLocale = app()->getLocale();
                        $otherLocale = $currentLocale == 'es' ? 'en' : 'es';
                        ?>
                        <input type="hidden" name="locale" value="{{ $otherLocale }}">
                        <img class="stylebandera" src="{{ asset('pics/common/'.$otherLocale.'.png') }}" alt="">
                    </button>
                </form>
            </li>


            <li class="colorB">
                <a href="#" class="text-uppercase colorB sinkinSans300L icon"><span
                            class="ti-search texto20 search-btn show-search-icon"></span></a>
                <div class="search-box" style="display: none;">
                    <form action="{{route('raffles.index.search')}}" method="get" onsubmit="return showLoad()">
                        <div class="input-group">
                            <input name="busqueda" placeholder="Search" class="form-control" type="text">
                            <span class="input-group-btn">
                                    <button class="btn btn-search btn-primary" type="submit">Search</button>
                                </span>
                        </div>
                    </form>
                </div>
            </li>

            @if(\Auth::user() != null)
                <li>
                    <a class="icon" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="texto20 ti-shift-right">
                        </span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </li>
            @endif

        </ul>
    </div>

</nav>

