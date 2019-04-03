
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
                <form class="form-signin" action="{{ route('raffle.finished.checkConfirmation',['raffleId' => $raffleId]) }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="raffleId" value="{{ $raffle->id }}">
                    <input type="hidden" name="user" value="{{ \Auth::user()->id }}">
                    <div class="form-group">
                        <label for="oconfirmation">El due&nacute;o de la rifa confirmó la entrega:</label>
                        <input type="checkbox" name="oconfirmation"
                               id="oconfirmation" {{ $confirmation->oconfirmation?'checked': '' }} {{ $confirmation->owner_id == \Auth::user()->id?'':'disabled' }}>
                    </div>
                    @if($confirmation->owner_id != \Auth::user()->id)
                        <input type="hidden" name="oconfirmation" value="{{ $confirmation->oconfirmation == 1?'on':'off' }}">
                    @endif
                    <div class="form-group">
                        <label for="wconfirmation">El ganador de la rifa confirmó la entrega:</label>
                        <input type="checkbox" name="wconfirmation"
                               id="wconfirmation" {{ $confirmation->wconfirmation?'checked': '' }} {{ $confirmation->winner_id == \Auth::user()->id? '': 'disabled' }}>
                    </div>
                    @if($confirmation->winner_id != \Auth::user()->id)
                        <input type="hidden" name="wconfirmation" value="{{ $confirmation->wconfirmation == 1?'on':'off' }}">
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
                            <button {{ $raffle->status == 6?'disabled':'' }} type="submit" class="btn btn-sm btn-primary btn-block">
                                Entrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>


