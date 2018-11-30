<!-- Modal-->
<div class="modal fade" id="createRaffleModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" style="width: 80% !important;">
        <div class="modal-content" style="width: 100% !important;">
            <div class="modal-header padding-left-0">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="padding-left: 5%">
                    <span class="ti-close"></span>
                </button>
                <h5 class="modal-title text-uppercase textoCenter padding-top-20">NUEVA RIFA</h5>
            </div>
            <div class="modal-body">

                <form class="col-md-12" action="/" method="POST">
                    <div class="col-md-4">
                        {{-- FIRST NAME ¦ LASTNAME --}}

                        <div class="col-md-6 pr-1">
                            <div class="form-group basic">
                                <label>Título de la rifa</label>
                                <input name="name" type="text" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-6 ">

                            <div class="form-group basic">
                                <label>Descripción de la rifa</label>
                                <textarea name="description" class="form-control" placeholder="Last Name">
                                </textarea>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <label for="selector"
                                   class="colorN italic padding-top-20">Email</label>
                            <input type="email" class="form-control form-control-new " id="inputEm"
                                   name="email">
                        </div>

                        <div class="col-md-8">
                            <label for="selector"
                                   class="colorN italic padding-top-20">Contraseña</label>
                            <input type="password" class="form-control form-control-new "
                                   id="inputPassword" name="password">
                        </div>

                        <div class="col-md-8">
                            <label for="selector"
                                   class="colorN italic padding-top-20">Repita la contraseña</label>
                            <input type="password" class="form-control form-control-new "
                                   id="inputPassword" name="password">
                        </div>

                    </div>

                    <div class="col-md-2">
                        <div class="row padding-top-20">
                            <div class="col-xs-5">
                                <button type="submit" class="btn btn-sm btn-primary btn-block">
                                    Update
                                </button>
                            </div>
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