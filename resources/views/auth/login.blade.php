@extends('layouts.loginbase')

@section('content')
    <div class="wrapper wrapper-full-page ">
        <div class="full-page login-page section-image" filter-color="black" data-image="{{ asset('pics/common/bg14.jpg') }}">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <div class="col-md-4 ml-auto mr-auto">
                        <form class="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="card card-login card-plain">
                                <div class="card-header ">
                                    <div class="logo-container">
                                        <img src="{{ asset('pics/common/now-logo.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="input-group form-control-lg">
                    <span class="input-group-addon">
                      <i class="now-ui-icons ui-1_email-85"></i>
                    </span>
                                        <input id="email" type="email" style="color: black;border: solid black 1px"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               placeholder="Your Email..." name="email" value="{{ old('email') }}"
                                               required autofocus>
                                        @if ($errors->has('email'))
                                            <div class="col-md-12"
                                                 style="padding-top: 20px!important;overflow-x: visible; overflow-y: visible; z-index: 2; height: 30px">
                                            <span class="invalid-feedback" style="display: block; width: 350px">
                                        <strong style="color: rgba(255,61,71,0.89)">{{ $errors->first('email') }}</strong>
                                        </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="input-group form-control-lg">
                    <span class="input-group-addon">
                      <i class="now-ui-icons ui-1_lock-circle-open"></i>
                    </span>
                                        <input type="password" id="password" placeholder="Password.."
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password" style="color: black;border: solid black 1px" required>
                                        @if ($errors->has('password'))
                                            <div class="col-md-12"
                                                 style="margin: 5px!important;overflow-x: visible; overflow-y: visible; z-index: 2; height: 30px">
                                            <span class="invalid-feedback" style="display: block; width: 350px">
                                        <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3">
                                        Started
                                    </button>
                                    <div class="pull-left">
                                        <h6>
                                            <a href="{{ route('register') }}" style="color: black" class="link footer-link">Create
                                                Account</a>
                                        </h6>
                                    </div>
                                    <div class="pull-right">
                                        <h6>
                                            <a href="{{ route('password.request') }}"
                                               style="color: black" class="link footer-link">Forgot?</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        , Designed by
                        <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by
                        <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>
    {{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
    {{--<div class="col-md-8">--}}
    {{--<div class="card">--}}
    {{--<div class="card-header">{{ __('Login') }}</div>--}}

    {{--<div class="card-body">--}}
    {{--<form method="POST" action="{{ route('login') }}">--}}
    {{--@csrf--}}

    {{--<div class="form-group row">--}}
    {{--<label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

    {{--<div class="col-md-6">--}}
    {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>--}}

    {{--@if ($errors->has('email'))--}}
    {{--<span class="invalid-feedback">--}}
    {{--<strong>{{ $errors->first('email') }}</strong>--}}
    {{--</span>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group row">--}}
    {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

    {{--<div class="col-md-6">--}}
    {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

    {{--@if ($errors->has('password'))--}}
    {{--<span class="invalid-feedback">--}}
    {{--<strong>{{ $errors->first('password') }}</strong>--}}
    {{--</span>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<a class="btn btn-primary" href="{{ route('social.auth', 'facebook') }}">--}}
    {{--Facebook--}}
    {{--</a>--}}

    {{--<div class="form-group row">--}}
    {{--<div class="col-md-6 offset-md-4">--}}
    {{--<div class="checkbox">--}}
    {{--<label>--}}
    {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}--}}
    {{--</label>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group row mb-0">--}}
    {{--<div class="col-md-8 offset-md-4">--}}
    {{--<button type="submit" class="btn btn-primary">--}}
    {{--{{ __('Login') }}--}}
    {{--</button>--}}

    {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
    {{--{{ __('Forgot Your Password?') }}--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
@endsection
