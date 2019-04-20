@extends('layouts.loginbase')

@section('content')


    <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
    <div class="content login-purple  padding-top-20">
        <div class="container" style="height: 100vh">
            <div class="col-md-4" style="margin: auto; top: 25%;">
                <form class="form " method="POST" action="{{ route('login') }}">
                    @csrf

                    <input type="text" name="adm" value="adm" hidden>

                    <div class="card card-login card-plain" style="background: transparent">
                        <div class="card-header ">
                            <div class="logo-container">
                                <img src="{{ asset('pics/front/logonv.png') }}" alt="">
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="input-group form-control-lg">

                                <input id="email" type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       placeholder="Your Email..." name="email" value="{{ old('email') }}"
                                       required autofocus style="background-color: white; color: black">
                                {{--<span class="now-ui-icons ui-1_email-85"></span>--}}
                                @if ($errors->has('email'))
                                    <div class="col-md-12 margin-bottom-20 margin-top20"
                                         style="padding-top: 10px!important;overflow-x: visible; overflow-y: visible; z-index: 1; height: 30px; background-color: #ffbf00; border-radius: 20px; margin-top: 5px">
                                            <span class="invalid-feedback" style="display: block; width: 350px">
                                        <strong style="color: white">{{ $errors->first('email') }}</strong>
                                            </span>
                                    </div>
                                    <div class="clearfix"></div>
                                @endif
                            </div>
                            <div class="input-group form-control-lg @if ($errors->has('email')) mt-5 @endif">
                                <input type="password" id="password" placeholder="Password.."
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" required style="background-color: white; color: black">
                                @if ($errors->has('password'))
                                    <div class="col-md-12"
                                         style="padding-top: 10px!important;overflow-x: visible; overflow-y: visible; z-index: 1; height: 30px; background-color: #ffbf00; border-radius: 20px; margin-top: 5px">
                                            <span class="invalid-feedback" style="display: block; width: 350px">
                                        <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer @if ($errors->has('password')) mt-5 @endif">
                            <button type="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection
