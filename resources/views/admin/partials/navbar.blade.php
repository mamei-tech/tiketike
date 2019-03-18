<nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top">
    <div class="container-fluid">

        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="">@yield('adminview', 'Dashboard')</a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>

        {{--RIGHT NAV--}}
        <div class="collapse navbar-collapse justify-content-end" id="navigation">

            <ul class="navbar-nav">

                <li class="nav-item dropdown" id="liLangSW">
                    @include('admin.components.langsw')
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdaown-toggle" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <p>
                            <span class="d-lg-none d-md-block">Notifications</span>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="list-unstyled" id="notifications_component">
                            @foreach(\Auth::user()->notifications as $notification)
                                <li>
                                    <span class="success">
                                    <a href="{{ $notification->data['url'] }}" style="color: black"> {!! $notification->data['data'] !!}</a>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="now-ui-icons users_single-02"></i>
                        <p>
                            <span class="d-lg-none d-md-block">@lang('aNavbar.userMenu')</span>
                        </p>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a id="navBar_logoutlink" class="dropdown-item" href="#navlogout-form">
                            @lang('aNavbar.logout')
                        </a>
                        @include('admin.partials.forms.navLogout_form')
                    </div>
                </li>

            </ul>

        </div>
    </div>
</nav>