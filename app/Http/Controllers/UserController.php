<?php

namespace App\Http\Controllers;


use App\Http\Aux\LogsMsgs;
use App\Http\Requests\StoreUserprofileRequest;
use App\Promo;
use App\Raffle;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Country;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{

    public function __construct()
    {
        // I think this is not needed because I have this in the route middleware
        $this->middleware('auth');
        $this->middleware('permission:edit user', ['only' => ['edit', 'update']]);
    }

    public function getProfile($userid)
    {
        $user = User::find($userid)->with('getProfile')->first();
        var_dump($user);
        var_dump($userid);die();
        $raffles = User::find($userid)->getRaffles;
        $rafflesfollowed = User::find($userid)->getRafflesFollowed;
        $rafflesbuyed = User::find($userid)->getRafflesBuyed;
        $tickets_buys = User::find($userid)->getTickets;

        $suggested = Raffle::with(['getTickets','getFollowers','getOwner'])
        ->whereDoesntHave('getFollowers',function (Builder $q) use ($user) {
            $q->where('user_id','<>',$user);
        })
        ->whereDoesntHave('getTickets',function (Builder $q) use ($user) {
            $q->where('buyer','<>',$user);
        })
        ->where('owner','<>',$user)
        ->limit(3)
        ->get();
        $promos = Promo::where('type',1)->where('status',1)->get();




        $countries = Country::paginate(10);

        $countrycities = DB::table('cities')
            ->select('cities.*')
            ->where('cities.country', $user->getProfile->getCity->getCountry->id)
            ->get();

        return view('user', [
            'user' => $user,
            'countries' => $countries,
            'countrycities' => $countrycities,
            'rafflesfollowed'=> $rafflesfollowed,
            'raffles'=>$raffles,
            'rafflesbuyed'=>$rafflesbuyed,
            'tickets_buys'=>$tickets_buys,
            'suggested' => $suggested,
            'promos' => $promos,

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

        return view('front_profile', [
            'user' => $user,
            'countries' => $countries,
            'countrycities' => $countrycities
        ]);
    }


    public function update(StoreUserprofileRequest $request, $userid)
    {
        var_dump($request->get('avatar'));
        die();

        // Get the user instance
        $user = User::with('getProfile')->findOrFail($userid);

        // Avatar ops
        if ($request->has('avatar') and $request->file('avatar')->isValid()) {
            $user->getProfile->clearMediaCollection('avatars');
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
            array_push($roles,$role);
        }
        $user->syncRoles($roles);

        // Logs the actions
        Log::info(LogsMsgs::$msgs['accepted'], [$user->getProfile->username, $userid]);

        return redirect()->route('profile.info',['userid'=>$userid])
            ->with('success', 'User "' . $user->getProfile->username . '" updated successfully');
    }



}
