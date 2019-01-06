<form class="form-horizontal" method="post" action="{{ route('arraffle.destroy', '')}}"
      accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="DELETE">

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

    <div class="row">
        <button id="deleteBtn" class="btn btn-danger btn-round" type="submit" value="post">
            <i class="now-ui-icons ui-1_simple-remove"></i>
            Delete
        </button>
    </div>
</form>

