@if ($errors->any())
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header padding-left-0">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                            style="padding-left: 5%">
                        <span class="ti-close"></span>
                    </button>
                    <h5 class="modal-title text-uppercase textoCenter padding-top-20">Error</h5>
                </div>
                <div class="modal-body">
                    <div id="err_admsec" class="col-md-12" style="z-index: 9">
                        <div class="alert alert-danger alert-with-icon">
                            <button type="button" aria-hidden="true" class="close btn-close">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                            </button>
                            <span data-notify="icon" class="now-ui-icons objects_support-17"></span>
                            <span data-notify="message">
                                <ul style="list-style: none; margin-bottom: 0;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
