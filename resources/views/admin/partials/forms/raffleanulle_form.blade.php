<form class="form-horizontal" method="post" action="{{ route('raffles.null', '')}}"
      accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{--<input name="_method" type="hidden" value="DELETE">--}}

    <div class="row">
        <label class="col-sm-3 col-form-label">Id</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_id" disabled="" class="form-control" type="text" name="id">
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">Title</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_title" disabled="" class="form-control" type="text" name="title">
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">Price</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_price" disabled="" class="form-control" type="text" name="price">
            </div>
        </div>
    </div>

    {{-- Only for publication views !!! --}}
    <div id="alternateprogressrow" class="row" style="display: none">
        <label class="col-sm-3 col-form-label">Progres</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_progress" disabled="" class="form-control" type="text" name="price">
            </div>
        </div>
    </div>


    <div class="row">
        <button id="anulleBtn" class="btn btn-danger btn-round" type="submit" value="post">
            <i class="now-ui-icons arrows-1_cloud-download-93"></i>
            Anulle
        </button>
    </div>
</form>

