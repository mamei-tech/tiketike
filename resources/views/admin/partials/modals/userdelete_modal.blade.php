<div class="modal fade login" id="mdal_deleteUser" style="display: none;" aria-hidden="true">

    <div class="modal-dialog animated">
        <div class="modal-content">

            {{--Modal Body--}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Sure 'u want to <b>delete</b> the user ?</h4>
            </div>

            {{--Modal Body--}}
            <div class="modal-body">
                <div class="container">

                    {{--<div class="">--}}
                    {{--<p> Enter the info for creating a Role </p>--}}
                    {{--</div>--}}


                    {{-- Ajax Errors Feedback --}}
                    @include('admin.partials.messagemodal')

                    <div id="frm_deleteUser" class="col-md-12">
                        @include('admin.partials.forms.usersdelete_form')

                        {{-- control --}}
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