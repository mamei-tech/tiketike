<div class="modal fade login" id="mdal_raffleReferrals" style="display: none;" aria-hidden="true">

    <div class="modal-dialog animated">
        <div class="modal-content">

            {{--Modal Body--}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Referrals </h4>
            </div>

            {{--Modal Body--}}
            <div class="modal-body">
                <div class="container">

                    @include('admin.partials.tables.referrals_table', ["referrals" => ['a', 'b', 'c']])

                </div>
            </div>
        </div>

    </div>
</div>