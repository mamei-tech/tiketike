<?php

namespace App\Http\Controllers;


use App\Http\TkTk\LogsMsgs;
use App\Http\Requests\StoreUserprofileRequest;
use App\Promo;
use App\Raffle;
use App\Repositories\RaffleRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Country;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{

    private $raffleRepository;
    public function __construct(RaffleRepository $raffleRepository)
    {
        // I think this is not needed because I have this in the route middleware
        $this->middleware('auth');
        $this->middleware('permission:edit user', ['only' => ['edit', 'update']]);
        $this->raffleRepository = $raffleRepository;
    }

    public function getProfile($userid)
    {
        $current = User::findOrFail(intval($userid));
        $suggested = $this->raffleRepository->getSuggested();
        $promos = Promo::where('type',1)->where('status',1)->get();
        return view('user', [
            'user' => $current,
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
//        var_dump('lallala');die();
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



    public function update(Request $request, $userid)
    {



        // Get the user instance
        $user = User::with('getProfile')->findOrFail($userid);

        // Avatar ops
        if ($request->has('avatar') and $request->file('avatar') != null) {
            $user->clearMediaCollection('avatars');
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars', 'avatars');  // Second parameters is de defaul filesystem, optional
//            $user->getProfile->avatarname = $request->avatar->getClientOriginalName();
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
