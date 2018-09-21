@extends('layouts.loginbase')

@section('content')
    <div class="wrapper wrapper-full-page ">
        <div class="full-page register-page section-image" filter-color="black"
             data-image="{{ asset('pics/bg16.jpg') }}">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="info-area info-horizontal mt-5">
                                <div class="icon icon-primary">
                                    <i class="now-ui-icons media-2_sound-wave"></i>
                                </div>
                                <div class="description">
                                    <h5 class="info-title">Marketing</h5>
                                    <p class="description">
                                        We've created the marketing campaign of the website. It was a very interesting
                                        collaboration.
                                    </p>
                                </div>
                            </div>
                            <div class="info-area info-horizontal">
                                <div class="icon icon-primary">
                                    <i class="now-ui-icons media-1_button-pause"></i>
                                </div>
                                <div class="description">
                                    <h5 class="info-title">Fully Coded in HTML5</h5>
                                    <p class="description">
                                        We've developed the website with HTML5 and CSS3. The client has access to the
                                        code using GitHub.
                                    </p>
                                </div>
                            </div>
                            <div class="info-area info-horizontal">
                                <div class="icon icon-info">
                                    <i class="now-ui-icons users_single-02"></i>
                                </div>
                                <div class="description">
                                    <h5 class="info-title">Built Audience</h5>
                                    <p class="description">
                                        There is also a Fully Customizable CMS Admin Dashboard for this product.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mr-auto">
                            <div class="card card-signup text-center">
                                <div class="card-header ">
                                    <h4 class="card-title">{{ __('Register') }}</h4>
                                    <div class="social">
                                        <button class="btn btn-icon btn-round btn-twitter">
                                            <i class="fab fa-twitter"></i>
                                        </button>
                                        <button class="btn btn-icon btn-round btn-google">
                                            <i class="fab fa-google"></i>
                                        </button>
                                        <a class="btn btn-icon btn-round btn-facebook" href="{{ route('social.auth','facebook') }}">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <h5 class="card-description"> or be classical </h5>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <form class="form" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="input-group">
                      <span class="input-group-addon">
                        <i class="now-ui-icons users_circle-08"></i>
                      </span>
                                            <input type="text" id="name"
                                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   placeholder="Name..." name="name" value="{{ old('name') }}" required
                                                   autofocus>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="input-group">
                      <span class="input-group-addon">
                        <i class="now-ui-icons ui-1_email-85"></i>
                      </span>
                                            <input id="email" type="email" placeholder="Email..."
                                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   name="email" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="input-group">
                      <span class="input-group-addon">
                        <i class="now-ui-icons ui-1_lock-circle-open"></i>
                      </span>
                                            <input type="password" id="password"
                                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   name="password" required placeholder="Password...">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="input-group">
                      <span class="input-group-addon">
                        <i class="now-ui-icons ui-1_lock-circle-open"></i>
                      </span>
                                            <input type="password" id="password-confirm" class="form-control"
                                                   name="password_confirmation" required
                                                   placeholder="Password Confirmation...">
                                        </div>
                                        <div class="form-check text-left">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox">
                                                <span class="form-check-sign"></span>
                                                I agree to the
                                                <a href="#something">terms and conditions</a>.
                                            </label>
                                        </div>
                                        <div class="card-footer ">
                                            <button type="submit" class="btn btn-primary btn-round btn-lg">
                                                {{ __('Register') }}
                                            </button>
                                            {{--<a href="#pablo" class="btn btn-primary btn-round btn-lg">Get Started</a>--}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
    {{--<div class="card-header">{{ __('Register') }}</div>--}}

    {{--<div class="card-body">--}}
    {{--<form method="POST" action="{{ route('register') }}">--}}
    {{--@csrf--}}

    {{--<div class="form-group row">--}}
    {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

    {{--<div class="col-md-6">--}}
    {{--<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>--}}

    {{--@if ($errors->has('name'))--}}
    {{--<span class="invalid-feedback">--}}
    {{--<strong>{{ $errors->first('name') }}</strong>--}}
    {{--</span>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group row">--}}
    {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

    {{--<div class="col-md-6">--}}
    {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>--}}

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

    {{--<div class="form-group row">--}}
    {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

    {{--<div class="col-md-6">--}}
    {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group row mb-0">--}}
    {{--<div class="col-md-6 offset-md-4">--}}
    {{--<button type="submit" class="btn btn-primary">--}}
    {{--{{ __('Register') }}--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
@endsection
