<!-- Modal-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog"
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
                <h5 class="modal-title text-uppercase textoCenter padding-top-20">Inicio de
                    sesión</h5>

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

                <form class="form-signin" action="login" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label for="selector" class="colorN italic">Nombre</label>
                    <input type="email" class="form-control form-control-new " id="inputEm"
                           name="email">
                    <label for="selector"
                           class="colorN italic padding-top-20">Contraseña</label>
                    <input type="password" class="form-control form-control-new "
                           id="inputPassword" name="password">
                    <div class="row padding-top-20">
                        <div class="col-xs-7">
                            <a href="#registerModal" onclick="
                                                        $('#loginModal').modal('hide');
                                                                " data-toggle="modal"
                               class="texto16"><span
                                        class="italic colorGreen floatRight">Regístrate</span></a>
                        </div>
                        <div class="col-xs-5">
                            <button type="submit" class="btn btn-sm btn-primary btn-block">
                                Entrar
                            </button>
                        </div>
                    </div>
                </form>

                <!-- TODO Aqui van los enlaces morrongueros del fi para acceder por las redes sociales -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- /.modal -->