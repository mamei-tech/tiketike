<form class="form-horizontal" method="post" action="{{ route('unpublished.publish', '')}}"
      accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{--<input name="_method" type="hidden" value="POST">--}}

    {{-- ID | Price --}}
    <div class="row">
        <div class="col-md-8">
            <div class="form-group basicmodal">
                <label for="tb_id">ID</label>
                <input id="tb_id" disabled class="form-control" type="text" name="id"/>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group basicmodal">
                <label>Price($)</label>
                <input id="tb_price" disabled class="form-control" type="text" name="price"/>
            </div>
        </div>
    </div>

    {{-- Profit | Commission --}}
    <div class="row">

        <div class="col-md-6">
            <div class="form-group basicmodal">
                <label for="tb_profit">Profit (%)</label>
                <input id="tb_profit" class="form-control" type="text" name="profit"/>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group basicmodal">
                <label for="tb_commissions">Comission(%)</label>
                <input id="tb_commissions" class="form-control" type="text" name="commissions"/>
            </div>
        </div>

    </div>

    {{-- Criteria Hidden --}}
    <input id="tb_criteria" type="hidden" value="" name="criteria"/>

    {{-- Ticket Count | Ticket Price --}}
    <div class="row">

        <div class="col-md-6">
            <div class="form-group basicmodal">
                <label for="tb_tcount">Ticket Count</label>
                <input id="tb_tcount" class="form-control" type="text" name="tcount"/>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group basicmodal">
                <label for="tb_tprice">Ticket Price($)</label>
                <input id="tb_tprice" class="form-control" type="text" name="tprice"/>
            </div>
        </div>

    </div>

    <br>

    <div class="row">
        <button id="publishBtn" class="btn btn-success btn-round" type="submit" value="post">
            <b>
                <i class="now-ui-icons arrows-1_share-66"></i>
                Publish
            </b>
        </button>
    </div>
</form>

