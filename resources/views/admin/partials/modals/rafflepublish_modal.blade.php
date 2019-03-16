<div class="modal fade login" id="mdal_publishRaffle" style="display: none;" aria-hidden="true">

    <div class="modal-dialog animated">
        <div class="modal-content">

            {{--Modal Body--}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Publish raffle</h4>
            </div>

            {{--Modal Body--}}
            <div class="modal-body">
                <div class="container">

                    {{--<div class="">--}}
                    {{--<p> Enter the info for creating a Role </p>--}}
                    {{--</div>--}}

                    {{-- Ajax Errors Feedback --}}
                    @include('admin.partials.messagemodal')

                    <div id="frm_publishRaffle" class="col-md-12">
                        @include('admin.partials.forms.rafflepublish_form')
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>