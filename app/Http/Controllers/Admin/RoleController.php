<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GeneralNotification;
use App\User;

class RoleController extends Controller
{
    // TODO Identify which methods apply to convert to rest method !!!!

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // I think this is not needed because I have this in the route middleware
        // Authentication
        $this->middleware('auth');

        /* TODO: Check what this is for, how to use it */
        // Authorization
            $this->middleware('permission:list roles');
            $this->middleware('permission:create role', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit role', ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO Select only the fields you need
        $roles = Role::paginate(10);
        $permissions = Permission::all();
        return view('admin.roles', [
            'roles' => $roles,
            'permissions' => $permissions,
            'div_showPeople' => 'show',
            'li_activeRoles' => 'active',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TODO Select only the fields you need

        $roles = DB::table('roles')->get();
        return view('admin.roles',
            [
                'roles' => $roles,
                'div_showPeople' => 'show',
                'li_activeRoles' => 'active',
                'show_create_modal' => 'show',
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        Role::create([
            'name' => $request->name,
            'guard_name' => $request->description,
        ]);

        $roles = DB::table('roles')->get();

        // TODO Try redirect with compact
        return redirect()->route('roles.index',
            [
                'roles' => $roles,
                'div_showPeople' => 'show',
                'li_activeRoles' => 'active',
            ],
            '303')
            ->with('success', 'Role "' . $request->name . '" created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRoleRequest $request, $id)
    {
        $role = Role::find($id);
        $permissions_request = $request->get('permissions');

        $role->name = $request->get('name');
        $role->guard_name = $request->get('description');
        $role->save();
        $perms = array();
        DB::table('role_has_permissions')->where('role_id',$role->id)->delete();
        if ($permissions_request != null) {
            foreach ($permissions_request as $permission) {
                $result = Permission::where('id', '=', $permission)->first()->name;
                $role->givePermissionTo($result);
            }
        }
//        $role->syncPermissions($result) ;
//        die();

        $roles = DB::table('roles')->get();
        $permissions = DB::table('permissions')->get();

        // TODO Try redirect with compact
        return redirect()->route('roles.index',
            [
                'roles' => $roles,
                'permissions' => $permissions,
                'div_showPeople' => 'show',
                'li_activeRoles' => 'active',
            ],
            '303')
            ->with('success', 'Role "' . $request->name . '" updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO Think in a validation, maybe add a custom Request parameter
        $role = Role::findById($id);
        $role->delete();

        $roles = DB::table('roles')->get();

        // TODO Try redirect with compact
        return redirect()->route('roles.index',
            [
                'roles' => $roles,
                'div_showPeople' => 'show',
                'li_activeRoles' => 'active',
            ],
            '303')
            ->with('success', 'Role "' . $id . '" deleted successfully');
    }
}