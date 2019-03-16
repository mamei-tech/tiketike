<div class="modal fade login" id="mdal_editCategory" style="display: none;" aria-hidden="true">

    <div class="modal-dialog animated">
        <div class="modal-content">

            {{--Modal Body--}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Edit a category</h4>
            </div>

            {{--Modal Body--}}
            <div class="modal-body">
                <div class="container">
                    {{-- Ajax Errors Feedback --}}
                    @include('admin.partials.messagemodal')

                    <div id="frm_editCategory" class="col-md-12">
                        @include('admin.partials.forms.categoryedit_form')
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>