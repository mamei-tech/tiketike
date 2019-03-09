<div class="sidebar" data-color="orange">
    <!-- Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow" -->
    <div class="logo">
        {{-- TODO Fix url here --}}
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            TK
        </a>
        {{-- TODO Fix url here --}}
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
            TikeTike
        </a>
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-simple btn-icon btn-neutral btn-round">
                <i class="now-ui-icons text_align-center visible-on-sidebar-regular"></i>
                <i class="now-ui-icons design_bullet-list-67 visible-on-sidebar-mini"></i>
            </button>
        </div>
    </div>

    <div class="sidebar-wrapper">
        {{-- USER SECTION --}}
        <div class="user">
            <div class="photo">
                @if(Auth::user()->getProfile->avatarname == 'default')
                    <img class="img-circle" src={{ asset('pics/common/default-avatar.png') }}/>
                @else
                    <img class="img-circle" src="{{ Auth::user()->getProfile->getMedia('avatars')->first()->getUrl() }}">
                @endif
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#usrProfile" class="collapsed">
              <span>
                {{ Auth::user()->name }}
                  <b class="caret"></b>
              </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="usrProfile">
                    <ul class="nav">

                        <li>
                            <a href="{{ route('users.edit', Auth::id()) }}">
                                <span class="sidebar-mini-icon"> P </span>
                                <span class="sidebar-normal">@lang('aSidebar.myProfile')</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <ul class="nav">

            {{-- DASHBOARD --}}
            <li class="@isset($li_activeDash) {{ $li_activeDash }} @endisset">
                <a href="{{ route('admin.index') }}">
                    <i class="now-ui-icons design_app"></i>
                    <p> Dashboard </p>
                </a>
            </li>

            {{-- PERSON SECC --}}
            <li>
                <a class="" data-toggle="collapse" href="#people_section" aria-expanded="false">
                    <i class="now-ui-icons users_circle-08"></i>
                    <p> @lang('aSidebar.people')
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse @isset($div_showPeople) {{ $div_showPeople }} @endisset" id="people_section">
                    <ul class="nav">
                        <li class="@isset($li_activeUsers) {{ $li_activeUsers }} @endisset">
                            <a href="{{ route('users.index') }}">
                                <span class="sidebar-mini-icon"> U </span>
                                <span class="sidebar-normal"> @lang('aSidebar.users') </span>
                            </a>
                        </li>

                        @can('list_roles')
                            <li class="@isset($li_activeRoles) {{ $li_activeRoles }} @endisset">
                                <a href="{{ route('roles.index') }}">
                                    <span class="sidebar-mini-icon"> R </span>
                                    <span class="sidebar-normal"> @lang('aSidebar.roles') </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>

            {{-- RAFFLE SECC --}}
            <li class="">
                <a class="" data-toggle="collapse" href="#raffle_section" aria-expanded="false">
                    <i class="now-ui-icons shopping_box"></i>
                    <p> @lang('aSidebar.raffles')
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse @isset($div_showRaffles) {{ $div_showRaffles }} @endisset" id="raffle_section">
                    <ul class="nav">

                        <li class="@isset($li_activePRaffles) {{ $li_activePRaffles }} @endisset">
                            <a href="{{ route('published.index') }}">
                                <span class="sidebar-mini-icon"> P </span>
                                <span class="sidebar-normal"> @lang('aSidebar.rpublished') </span>
                            </a>
                        </li>

                        <li class="@isset($li_activeURaffles) {{ $li_activeURaffles }} @endisset">
                            <a href="{{ route('unpublished.index') }}">
                                <span class="sidebar-mini-icon"> U </span>
                                <span class="sidebar-normal"> @lang('aSidebar.runpublished') </span>
                            </a>
                        </li>

                        <li class="@isset($li_activeARaffles) {{ $li_activeARaffles }} @endisset">
                            <a href="{{ route('arraffle.index') }}">
                                <span class="sidebar-mini-icon"> A </span>
                                <span class="sidebar-normal"> @lang('aSidebar.ranulled') </span>
                            </a>
                        </li>

                        <li class="@isset($li_activeRCategories) {{ $li_activeRCategories }} @endisset">
                            <a href="{{ route('categories.index') }}">
                                <span class="sidebar-mini-icon"> Ca </span>
                                <span class="sidebar-normal"> @lang('Categories') </span>
                            </a>
                        </li>

                        <li class="@isset($li_activeRConfig) {{ $li_activeRConfig }} @endisset">
                            <a href="{{ route('admin.raffle.showconfig') }}">
                                <span class="sidebar-mini-icon"> C </span>
                                <span class="sidebar-normal"> @lang('Configuration') </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            {{-- Promos & Ads SECC --}}
            <li class="">
                <a class="" data-toggle="collapse" href="#promo_section" aria-expanded="false">
                    <i class="now-ui-icons objects_diamond"></i>
                    <p> Promos & Ads
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse @isset($div_showPromo) {{ $div_showPromo }} @endisset" id="promo_section">
                    <ul class="nav">

                        <li class="@isset($li_activePromoList) {{ $li_activePromoList }} @endisset">
                            <a href="{{ route('promos.index') }}">
                                <span class="sidebar-mini-icon"> L </span>
                                <span class="sidebar-normal"> List </span>
                            </a>
                        </li>

                        <li class="@isset($li_activePromoClients) {{ $li_activePromoClients }} @endisset">
                            <a href="{{ route('pmclients.index') }}">
                                <span class="sidebar-mini-icon"> C </span>
                                <span class="sidebar-normal"> Clients  </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            {{--payments controll--}}
            <li class="">
                <a class="" data-toggle="collapse" href="#payment_section" aria-expanded="false">
                    <i class="now-ui-icons business_money-coins"></i>
                    <p> Payments
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse @isset($div_showPromo) {{ $div_showPromo }} @endisset" id="payment_section">
                    <ul class="nav">

                        <li class="@isset($li_activePromoList) {{ $li_activePromoList }} @endisset">
                            <a href="{{ route('payment.executed') }}">
                                <span class="sidebar-mini-icon"> E </span>
                                <span class="sidebar-normal"> Executed </span>
                            </a>
                        </li>

                        <li class="@isset($li_activePromoClients) {{ $li_activePromoClients }} @endisset">
                            <a href="{{ route('payment.pending.list') }}">
                                <span class="sidebar-mini-icon"> P </span>
                                <span class="sidebar-normal"> Pending  </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            {{-- LOGS SECC --}}
            <li class="">
                <a class="" data-toggle="collapse" href="#logs_section" aria-expanded="false">
                    <i class="now-ui-icons files_box"></i>
                    <p> Logs
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse @isset($div_showLogs) {{ $div_showLogs }} @endisset" id="logs_section">
                    <ul class="nav">

                        <li class="@isset($li_activeLogsDashborad) {{ $li_activeLogsDashborad }} @endisset">
                            <a href="{{ route('log-viewer::dashboard') }}">
                                <span class="sidebar-mini-icon"> D </span>
                                <span class="sidebar-normal"> Dashborad </span>
                            </a>
                        </li>

                        <li class="@isset($li_activeLogsList) {{ $li_activeLogsList }} @endisset">
                            <a href="{{ route('log-viewer::logs.list') }}">
                                <span class="sidebar-mini-icon"> U </span>
                                <span class="sidebar-normal"> List  </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>