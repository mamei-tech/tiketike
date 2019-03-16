<table id="tbl_roles" class="table table-striped table-bordered" cellspacing="0" width="100%" style="table-layout: fixed; word-wrap:break-word;">

    <thead class=" text-primary">
    <tr>
        <th>
            ID
        </th>
        <th>
            Role
        </th>
        <th>
            Guard
        </th>
        <th>Permissions</th>
        <th class="disabled-sorting text-right">
            Actions
        </th>
    </tr>
    </thead>

    <tbody>
    @foreach ($roles as $key => $role)
        <tr>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>
            <td>{{ $role->guard_name }}</td>
            <td>
                <?php
                $perm = '';
                foreach ($role->permissions as $permission) {
                    $role = explode(" ",$permission->name);
                    $perm.=$permission->name.',';
                }
                ?>
                {{ $perm }}
            </td>
            <td class="text-right">
                <a class="btn btn-success btn-icon btn-sm edit" href="">
                    <i class="now-ui-icons ui-2_settings-90"></i>
                </a>
                <a class="btn btn-danger btn-icon btn-sm remove" href="">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </a>
            </td>
        </tr>
    @endforeach
</table>