<!-- Modal-->
<div class="modal fade" id="confirmation_modal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header form-signin padding-left-0">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="ti-angle-right"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 "></div>
                <h5 class="modal-title text-uppercase textoCenter padding-top-20">Confirmacion de rifa</h5>
                <form class="form-signin" action="login" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="raffleId" value="{{ $raffle->id }}">
                    <input type="hidden" name="user" value="{{ \Auth::user()->id }}">
                    <div class="form-group">
                        <label for="oconfirmation">El due&nacute;o de la rifa confirmó la entrega:</label>
                        <input type="checkbox" name="oconfirmation"
                               id="oconfirmation" {{ $confirmation->oconfirmation?'checked': '' }} {{ $raffle->getOwner->id == \Auth::user()->id?'':'disabled' }}>
                    </div>
                    @if($confirmation->oconfirmation)
                        <input type="hidden" name="oconfirmation" value="{{ $confirmation->oconfirmation }}">
                    @endif
                    <div class="form-group">
                        <label for="wconfirmation">El ganador de la rifa confirmó la entrega:</label>
                        <input type="checkbox" name="wconfirmation"
                               id="wconfirmation" {{ $confirmation->wconfirmation?'checked': '' }} {{ $ticket->getBuyer->id == \Auth::user()->id? '': 'disabled' }}>
                    </div>
                    @if($confirmation->wconfirmation)
                        <input type="hidden" name="wconfirmation" value="{{ $confirmation->wconfirmation }}">
                    @endif
                    {!! app('captcha')->display() !!}
                    <div class="g-recaptcha"
                         data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}">
                    </div>
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                    @endif
                    <div class="row padding-top-20">

                        <div class="col-xs-5 pull-right">
                            <button type="submit" class="btn btn-sm btn-primary btn-block">
                                Entrar
                            </button>
                        </div>
                    </div>
                </form>


                <h5 class="modal-title text-uppercase textoCenter padding-top-20">@lang('Register With')</h5>

                <div class="col-xs-12 text-center margin-bottom-40">
                    <a class="btn btn-facebook" href="{{ route('social.auth', 'facebook') }}">
                        <span class="ti-facebook texto-negrita colorV margin-right-5 texto16" title="Facebook"></span>
                    </a>
                    <a class="btn btn-twitter" href="{{ route('social.auth', 'twitter') }}">
                        <span class="ti-twitter texto-negrita colorV margin-right-5 texto16" title="Twitter"></span>
                    </a>
                    <a class="btn btn-google" href="{{ route('social.auth', 'google') }}">
                        <span class="ti-google texto-negrita colorV margin-right-5 texto16" title="Google"></span>
                    </a>
                    <a class="btn btn-linkedin" href="{{ route('social.auth', 'linkedin') }}">
                        <span class="ti-linkedin texto-negrita colorV margin-right-5 texto16" title="Linkedin"></span>
                    </a>
                </div>

                <!-- TODO Aqui van los enlaces morrongueros del fi para acceder por las redes sociales -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- /.modal -->