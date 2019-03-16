<table id="table_users" class="table table-striped table-bordered" cellspacing="0" width="100%">

    {{--Header--}}
    <thead class=" text-primary">
    <tr>
        <th>ID</th>
        <th>@lang('Name')</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Role</th>
        <th class="disabled-sorting text-right">@lang('Actions')</th>
    </tr>
    </thead>

    {{--Footer--}}
    <tfoot>
    <tr>
        <th>ID</th>
        <th rowspan="1" colspan="1">@lang('Name')</th>
        <th rowspan="1" colspan="1">Last Name</th>
        <th rowspan="1" colspan="1">Email</th>
        <th rowspan="1" colspan="1">Role</th>
        <th class="disabled-sorting text-right" rowspan="1" colspan="1">Actions</th>
    </tr>
    </tfoot>

    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->lastname}}</td>
            <td>{{$user->email}}</td>
            <td>
                @foreach($user->roles as $role)
                    {{ $role->name }}
                @endforeach
            </td>
            <td class="text-right">
                <a class="btn btn-info btn-icon btn-sm like" href="">
                    <i class="now-ui-icons users_single-02"></i>
                </a>
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