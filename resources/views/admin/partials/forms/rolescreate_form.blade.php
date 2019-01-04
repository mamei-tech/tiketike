<form class="form-horizontal" method="post" action="{{ route('roles.store') }}"
      accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
    {{ csrf_field() }}

    <div class="row">
        <label class="col-sm-3 col-form-label">Role Name</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_name" class="form-control" type="text" placeholder="name" name="name" required>
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">Description</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_description" class="form-control" type="text" placeholder="description"
                       name="description">
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

