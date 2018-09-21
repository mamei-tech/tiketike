<div class="modal fade login" id="mdal_createPromo" style="display: none;" aria-hidden="true">

    <div class="modal-dialog animated">
        <div class="modal-content">

            {{--Modal Body--}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Add a Promo </h4>
            </div>

            {{--Modal Body--}}
            <div class="modal-body">
                <div class="container">

                    {{--<div class="">--}}
                        {{--<p> Enter the info for creating a Role </p>--}}
                    {{--</div>--}}

                    {{-- Ajax Errors Feedback --}}
                    @include('admin.partials.messagemodal')

                    <div id="frm_createPromo" class="col-md-12">
                        @include('admin.partials.forms.promocreate_form')

                        {{-- control --}}
                        {{-- this is for /created specific URL controller response method --}}
                        <span id="show_modal" hidden>@isset($show_create_modal){{ $show_create_modal }}@endisset</span>
                    </div>

                </div>
            </div>

            {{--Modal Footer--}}
            {{--<div class="modal-footer">--}}
            {{--<div class="">--}}
            {{--<p></p>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>

    </div>
</div>