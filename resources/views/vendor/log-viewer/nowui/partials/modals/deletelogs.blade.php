{{-- DELETE MODAL --}}
<div id="delete-log-modal" class="modal fade login" tabindex="-1" role="dialog">

    <div class="modal-dialog animated" role="document">
        <div class="modal-content">

            {{--Modal Body--}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Sure 'u want to <b>delete</b> the log ?</h4>
            </div>


            {{--Modal Body--}}
            <div class="modal-body">
                <div class="container">

                    <p> @lang('aLogs.deletemodal') </p>

                    <form id="delete-log-form" action="{{ route('log-viewer::logs.delete') }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="date" value="">


                        <button type="submit" class="btn btn-danger btn-round" data-loading-text="Loading&hellip;">
                            <i class="now-ui-icons ui-1_simple-remove"></i>
                            @lang('Delete')
                        </button>
                    </form>

                    {{--<div class="modal-footer">--}}

                    {{--</div>--}}

                </div>
            </div>

            {{--Modal Footer--}}
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-round mr-auto" data-dismiss="modal">Cancel</button>--}}

            </div>

        </div>
    </div>
</div>