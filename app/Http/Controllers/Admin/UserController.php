<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserprofileRequest;
use App\User;
use App\Country;
use App\Http\Aux\LogsMsgs;

class UserController extends Controller
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
        $this->middleware('auth');
        $this->middleware('permission:list users');
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO Get the user role show it in the table
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
//        var_dump($request->get('roles'));
//        die();
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
        Log::info(LogsMsgs::$msgs['accepted'], [$user->getProfile->username, $userid]);

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
        Log::info(LogsMsgs::$msgs['accepted'], [$user->getProfile->username, $userid]);
        return redirect()->route('users.index')
            ->with('success', 'User "' . $user->getProfile->username . '" updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // TODO delclare in the routes the methods that you are not going to use
}
