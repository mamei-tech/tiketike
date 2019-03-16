<!-- Modal-->
<div class="modal fade" id="{{$raffle->id}}-share_modal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" style="width: 60% !important; height: 300px !important;">
        <div class="modal-content" style="width: 100% !important;">
            <div class="modal-header padding-left-0">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="padding-left: 5%">
                    <span class="ti-close"></span>
                </button>
                <h5 class="modal-title text-uppercase textoCenter padding-top-20">Share</h5>
            </div>
            <div class="modal-body">
                <div class="col-xs-12 text-center margin-bottom-40">
                    @if(Auth::check())
                    <a class=" btn-facebook padding-left30" href="https://www.facebook.com/sharer/sharer.php?u={{route('referrals.tickets.buy',[$raffle->id, Auth::user()->id,'socialNetworkId' => 1])}}">
                        <span class="ti-facebook texto-negrita colorV margin-right-5 texto35" title="Facebook"></span>
                    </a>
                    <a class=" btn-twitter padding-left30" href="https://twitter.com/home?status={{route('referrals.tickets.buy',[$raffle->id, Auth::user()->id,'socialNetworkId' => 2])}}">
                        <span class="ti-twitter texto-negrita colorV margin-right-5 texto35" title="Twitter"></span>
                    </a>
                    <a class=" padding-left30" href="mailto:?&cc=&bcc=&subject=Good Raffle for you&body={{route('referrals.tickets.buy',[$raffle->id, Auth::user()->id,'socialNetworkId' => 3])}}">
                        <span class="ti-email texto-negrita colorV margin-right-5 texto35" title="Email"></span>
                    </a>

                </div>

                <div class="input-group">
                    <input type="text" class="form-control" readonly id="copylink" value="{{route('referrals.tickets.buy',[$raffle->id, Auth::user()->id,'socialNetworkId' => 0])}}">

                    <!-- Trigger -->
                    <span class="input-group-btn">
                    <button class="btn btn-icon btncopy" data-clipboard-target="#copylink">
                        <i class="ti-agenda"></i>
                    </button>
                    </span>
                </div>

            @endif
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
