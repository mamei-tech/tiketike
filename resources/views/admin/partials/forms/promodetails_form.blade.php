<form class="form-horizontal" method="post" action="" accept-charset="UTF-8" enctype="multipart/form-data">

    {{-- NAME | EXP DATE | LINK --}}
    <div class="row">

        <div class="col-md-4">
            <div class="form-group basicmodal">
                <label for="tb_name">Name</label>
                <p id="tb_name" class="form-control-static"></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group basicmodal">
                <label for="tb_expdate">Exp Date</label>
                <p id="tb_expdate" class="form-control-static"></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group basicmodal">
                <p class="form-control-static">
                    <b>
                        {{--<span><i class="now-ui-icons ui-1_zoom-bold"></i></span>--}}
                        <a id="tb_website" href="" target="_blank" rel="noopener noreferrer">Reference</a>
                    </b>
                </p>
            </div>
        </div>

    </div>

    {{-- CLIENT | TYPE | STATUS --}}
    <div class="row">

        <div class="col-md-4">
            <div class="form-group basicmodal">
                <label for="tb_client">Client</label>
                <br style="margin-top: 6px">            {{--Drawback--}}
                <span id="s_clientid" value="" hidden></span>
                <a href="{{route('pmclients.show', '')}}" target="_blank" id="tb_client" class="form-control-static"></a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group basicmodal">
                <label for="tb_type">Type</label>
                <p id="tb_type" class="form-control-static"></p>
            </div>

        </div>

        <div class="col-md-4">
            <div class="form-group basicmodal">
                <label for="tb_status">Status</label>
                <p id="tb_status" class="form-control-static"></p>
            </div>
        </div>

    </div>

    {{-- IMGS --}}
    <div class="row">

        <div class="col-md-4">
            <div class="form-group basicmodal">
                <label for="tb_alt">Alternative</label>
                <p id="tb_alt" class="form-control-static" style="text-align: justify">Esta es una prueva de lo que puede ir en
                    este lugar. Si en este lugar.
                </p>
            </div>
        </div>

        <div class="col-md-8">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                <div class="fileinput thumbnailpromo">
                    <img id="promo-img" src="{{ asset('pics/common/image_placeholder.jpg') }}" alt="">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style=""></div>
            </div>
        </div>

    </div>

    <br>

    <div class="row">
        <button id="closeBtn" class="btn btn-primary btn-round" type="button" data-dismiss="modal" aria-hidden="true">
            <i class="now-ui-icons ui-1_simple-remove"></i>
            <b>
                Close
            </b>
        </button>
    </div>

    <br>
</form>