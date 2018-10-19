<!-- Modal-->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog"
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
                <h5 class="modal-title text-uppercase textoCenter padding-top-20">Registro</h5>
                <form class="form-signin" action="login" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label for="selector" class="colorN italic">Nombre</label>
                    <input type="text" class="form-control form-control-new " id="inputEm"
                           name="name">
                    <label for="selector" class="colorN italic">Apellidos</label>
                    <input type="text" class="form-control form-control-new " id="inputEm"
                           name="lastname">
                    <label for="selector" class="colorN italic">Email</label>
                    <input type="text" class="form-control form-control-new " id="inputEm"
                           name="email">
                    <label for="selector"
                           class="colorN italic padding-top-20">Contraseña</label>
                    <input type="password" class="form-control form-control-new "
                           id="inputPassword" name="password">
                    <label for="selector"
                           class="colorN italic padding-top-20">Repita la contraseña</label>
                    <input type="re-password" class="form-control form-control-new "
                           id="inputPassword" name="re-password">
                    <div class="row padding-top-20">
                        <div class="col-xs-7">
                        </div>

                        <!-- TODO Aqui van los botones cagados del fi -->
                        <div class="col-xs-5">
                            <button type="submit" class="btn btn-sm btn-primary btn-block">
                                Registrarme
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