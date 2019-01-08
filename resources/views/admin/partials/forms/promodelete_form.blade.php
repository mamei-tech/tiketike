<form class="form-horizontal" method="post" action="{{ route('promos.destroy', '')}}"
      accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="DELETE">

    <div class="row">
        <label class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_name" disabled="" class="form-control" type="text" placeholder="name" name="name">
            </div>
        </div>
    </div>

    <div class="row">
        <button id="deleteBtn" class="btn btn-danger btn-round" type="submit" value="delete">
            <i class="now-ui-icons ui-1_simple-remove"></i>
            @lang('Delete')
        </button>
    </div>
</form>

