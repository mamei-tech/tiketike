<div class="modal fade login" id="mdal_addRaffle" style="display: none;" aria-hidden="true">

    <div class="modal-dialog animated">
        <div class="modal-content">

            {{--Modal Body--}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Create a raffle</h4>
            </div>

            {{--Modal Body--}}
            <div class="modal-body">
                <div class="container">
                    {{-- Ajax Errors Feedback --}}
                    @include('admin.partials.messagemodal')

                    <div id="frm_createRaffle" class="col-md-12">
                        @include('admin.partials.forms.rafflecreate_form')

                        {{--TODO Change this proper to this view--}}
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>