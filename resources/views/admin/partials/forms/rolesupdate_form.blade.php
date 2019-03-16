<form class="form-horizontal" method="post" action="{{route('roles.update', '')}}"
      accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="PUT">

    <div class="row">
        <label class="col-sm-3 col-form-label">Role Name</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_name" class="form-control" type="text" placeholder="name" name="name">
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">Guard name</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_description" class="form-control" type="text" placeholder="Guard name"
                       name="description">
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">Permissions</label>
        <div class="col-sm-9">
                @foreach($permissions as $permission)
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="permissions[]" id="i{{ $permission->name}}"  type="checkbox" value="{{ $permission->id }}">
                        <span class="form-check-sign"></span>
                        {{ $permission->name }}
                    </label>
                </div>
                @endforeach
        </div>
    </div>

    <div class="row">
        <button id="btn_roleupdatesubmt" class="btn btn-primary btn-round" type="submit" value="update">
            <i class="now-ui-icons ui-1_check"></i>
            Update
        </button>
    </div>
</form>

