<div class="modal fade login" id="mdal_deletePromoClient" style="display: none;" aria-hidden="true">

    <div class="modal-dialog animated">
        <div class="modal-content">

            {{--Modal Body--}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Sure 'u want to <b>delete</b> this promo client ?</h4>
            </div>

            {{--Modal Body--}}
            <div class="modal-body">
                <div class="container">

                    {{--<div class="">--}}
                        {{--<p> Enter the info for creating a Role </p>--}}
                    {{--</div>--}}


                    {{-- Ajax Errors Feedback --}}
                    {{--@include('admin.partials.messagemodal')--}}

                    <div id="frm_deletePromoclient" class="col-md-12">
                        @include('admin.partials.forms.promoclientsdelete_form')

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