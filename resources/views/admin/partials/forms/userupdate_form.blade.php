<form class="form-horizontal" method="post" action="{{route('users.updateadmin','')}}"
      accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="PUT">

    <div class="row">
        <label class="col-sm-3 col-form-label">User Name</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_name" class="form-control" type="text" placeholder="name" name="name">
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">User Lastname</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_lastname" class="form-control" type="text" placeholder="lastname" name="lastname">
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">User Email</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_email" class="form-control" type="text" placeholder="Email"
                       name="email">
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">User Role</label>
        <div class="col-sm-9">
            <div class="form-group">
                <select name="roles[]" id="tb_roles" class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Select Role" multiple="multiple">
                    @foreach($roles as $role)
                        <option value="{{$role->id}}" id="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <button id="btn_roleupdatesubmt" class="btn btn-primary btn-round" type="submit" value="update">
            <i class="now-ui-icons ui-1_check"></i>
            Update
        </button>
    </div>
</form>

