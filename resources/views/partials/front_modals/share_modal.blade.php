<!-- Modal-->
<div class="modal fade" id="share_modal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" style="width: 60% !important;">
        <div class="modal-content" style="width: 100% !important;">
            <div class="modal-header padding-left-0">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="padding-left: 5%">
                    <span class="ti-close"></span>
                </button>
                <h5 class="modal-title text-uppercase textoCenter padding-top-20">Share</h5>
            </div>
            <div class="modal-body">

                <div class="col-xs-12 text-center margin-bottom-40">
                    <a class="btn btn-facebook" href="{{ route('social.auth', 'facebook') }}">
                        <span class="ti-facebook texto-negrita colorV margin-right-5 texto16" title="Facebook"></span>
                    </a>
                    <a class="btn btn-twitter" href="{{ route('social.auth', 'twitter') }}">
                        <span class="ti-twitter texto-negrita colorV margin-right-5 texto16" title="Twitter"></span>
                    </a>
                    <a class="btn " href="mailto:&body={{url()}}">
                        <span class="ti-email texto-negrita colorV margin-right-5 texto16" title="Email"></span>
                    </a>
                    <a class="btn btn-linkedin" href="{{ route('social.auth', 'linkedin') }}">
                        <span class="ti-linkedin texto-negrita colorV margin-right-5 texto16" title="Linkedin"></span>
                    </a>
                    <a class="btn btn-pinterest" href="{{ route('social.auth', 'linkedin') }}">
                        <span class="ti-pinterest texto-negrita colorV margin-right-5 texto16" title="Pinterest"></span>
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
