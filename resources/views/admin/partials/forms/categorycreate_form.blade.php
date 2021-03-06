<form class="form-horizontal" method="post" action="{{ route('categories.store') }}"
      accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
    {{ csrf_field() }}

    <div class="row">
        <label class="col-sm-3 col-form-label">Category name</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_category" class="form-control" type="text" placeholder="Category name" name="category"
                       required>
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">Icon</label>
        <div class="col-sm-9">
            <div class="form-group">
                <div class="form-check form-check-radio" style="float: left">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="arrows-1_cloud-download-93">
                        <span class="form-check-sign"></span>
                        <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <button id="btn_rolescreatesubmt" class="btn btn-primary btn-round" type="submit" value="add">
            <i class="now-ui-icons ui-1_simple-add"></i>
            Add
        </button>
    </div>
</form>

