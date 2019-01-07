<div class="modal fade login" id="mdal_updateRole" style="display: none;" aria-hidden="true">

    <div class="modal-dialog animated">
        <div class="modal-content">

            {{--Modal Body--}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Edit Role </h4>
            </div>

            {{--Modal Body--}}
            <div class="modal-body">
                <div class="container">

                    {{--<div class="">--}}
                        {{--<p> Enter the info for creating a Role </p>--}}
                    {{--</div>--}}

                    {{-- Ajax Errors Feedback --}}
                    @include('admin.partials.messagemodal')

                    <div id="frm_updateRole" class="col-md-12">
                        @include('admin.partials.forms.rolesupdate_form')

                        {{--control--}}
                        {{--<span id="show_modal" hidden>@isset($show_create_modal){{ $show_create_modal }}@endisset</span>--}}
                    </div>

                </div>
            </div>

            {{--Modal Footer--}}
            <div class="modal-footer">
                <div class="">
                    <p></p>
                </div>
            </div>
        </div>

    </div>
</div>