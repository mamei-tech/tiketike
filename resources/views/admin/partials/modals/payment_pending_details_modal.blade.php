<div class="modal fade login" id="pp_details" style="display: none;" aria-hidden="true">

    <div class="modal-dialog animated">
        <div class="modal-content">

            {{--Modal Body--}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Payment Details</h4>
            </div>

            {{--Modal Body--}}
            <div class="modal-body">
                <div class="container">

                    {{--<div class="">--}}
                    {{--<p> Enter the info for creating a Role </p>--}}
                    {{--</div>--}}

                    {{-- Ajax Errors Feedback --}}
                    @include('admin.partials.messagemodal')

                    <div id="details_description" class="col-md-12">

                    </div>

                    <div id="details_content" class="col-md-12">

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