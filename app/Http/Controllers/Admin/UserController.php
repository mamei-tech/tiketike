<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DeletingUserRequest;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserprofileRequest;
use App\User;
use App\Country;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:user_list')          ->  only(['index']);
        $this->middleware('permission:user_update')        ->  only(['update']);
        $this->middleware('permission:user_edit')          ->  only(['edit']);
        $this->middleware('permission:user_destroy')       ->  only(['destroy']);
        $this->middleware('permission:user_updateadmin')   ->  only(['updateadmin']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        $roles = Role::paginate(10);
        return view('admin.users', [
            'users' => $users,
            'roles' => $roles,
            'div_showPeople' => 'show',
            'li_activeUsers' => 'active',
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $userid
     * @return \Illuminate\Http\Response
     */
    public function edit($userid)
    {
        $user = User::with('getProfile')->findOrFail($userid);

        $countries = Country::paginate(10);
        $countrycities = DB::table('cities')
            ->select('cities.*')
            ->where('cities.country', $user->getProfile->getCity->getCountry->id)
            ->get();


        return view('admin.userprofile', [
            'user' => $user,
            'countries' => $countries,
            'countrycities' => $countrycities
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUserprofileRequest $request
     * @param  int $userid
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserprofileRequest $request, $userid)
    {
        // Get the user instance
        $user = User::with('getProfile')->findOrFail($userid);

        // Avatar ops
        if ($request->has('avatar') and $request->file('avatar')->isValid()) {
            $user->getProfile->addMediaFromRequest('avatar')->toMediaCollection('avatars', 'avatars');  // Second parameters is de defaul filesystem, optional
            $user->getProfile->avatarname = $request->avatar->getClientOriginalName();
        }

        if ($request->has('password') && $request->get('password') != '') {
            $user->password = bcrypt($request->get('password'));
        }

        // Filling all the user inputs form
        $user->name = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');

        if (isset($request->all()['birthdate']))
            $user->getProfile->birthdate = date('Y-m-d', strtotime($request->get('birthdate')));
        if (isset($request->all()['gender']))
            $user->getProfile->gender = $request->get('gender');
        if (isset($request->all()['city']))
            $user->getProfile->city = $request->get('city');
        if (isset($request->all()['languaje']))
            $user->getProfile->langcode = $request->get('languaje');
        if (isset($request->all()['bio']))
            $user->getProfile->bio = $request->get('bio');
        if (isset($request->all()['address']))
            $user->getProfile->addrss = $request->get('address');
        if (isset($request->all()['zipcode']))
            $user->getProfile->zipcode = $request->get('zipcode');

        // Saving user and user's profile
        $user->getProfile->save();
        $user->save();
        $roles = array();
        foreach (array_get($request->all(), 'roles', []) as $role) {
            array_push($roles, $role);
        }
        $user->syncRoles($roles);

        // Getting cities and countries for retriving it
        $countries = Country::all();
        $countrycities = DB::table('cities')
            ->select('cities.*')
            ->where('cities.country', $user->getProfile->getCity->getCountry->id)
            ->get();

        // Logs the actions
        Log::log('INFO', trans('aLogs.user_prof_updated'), [
            'user'      => Auth::user()->id,
        ]);

        return redirect()->route('users.edit',
            [
                'user' => $user,
                'countries' => $countries,
                'countrycities' => $countrycities
            ],
            '303')
            ->with('success', 'User "' . $user->getProfile->username . '" updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $userid
     * @return \Illuminate\Http\Response
     */
    public function updateadmin(Request $request, $userid)
    {
        $user = User::with('getProfile')->findOrFail($userid);
        $user->name = $request->get('name');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->save();
        $roles = array();
        foreach (array_get($request->all(), 'roles', []) as $role) {
            array_push($roles, $role);
        }
        $user->syncRoles($roles);

        Log::log('INFO', trans('aLogs.user_prof_updated'), [
            'user'      => Auth::user()->id,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User "' . $user->getProfile->username . '" updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        User::destroy($user);

        Log::log('INFO', trans('aLogs.user_prof_deleted'), [
            'user'      => Auth::user()->id,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
