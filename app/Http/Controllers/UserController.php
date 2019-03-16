<?php

namespace App\Http\Controllers;


use App\City;
use App\Http\Requests\StoreUserprofileRequest;
use App\Promo;
use App\Repositories\RaffleRepository;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Country;
use Arcanedev\LogViewer\Entities\Log;

class UserController extends Controller
{
    private $raffleRepository;

    public function __construct(RaffleRepository $raffleRepository)
    {
        $this->middleware('permission:user_front_getprofile')       ->  only(['getProfile']);
        $this->middleware('permission:user_front_edit')             ->  only(['edit']);
        $this->middleware('permission:user_front_update')           ->  only(['update']);

        $this->raffleRepository = $raffleRepository;
    }

    public function getProfile($userid)
    {
        $current = User::findOrFail(intval($userid));
        $suggested = $this->raffleRepository->getSuggested();
        $promos = Promo::where('type', 1)->where('status', 1)->get();
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
        $user = User::with('getProfile')->findOrFail($userid);
        $countries = Country::all();
        $countrycities = null;
        $first_time = true;
        if ($user->getProfile()->exists()){
            $countrycities = City::with('country')->whereHas('country', function (Builder $q) use ($user) {
                $q->where('id',$user->getProfile->getCity->country->id);
            })
                ->get();
            $first_time = false;
        }


        return view('front_profile', [
            'user' => $user,
            'countries' => $countries,
            'countrycities' => $countrycities,
            'first_time' => $first_time
        ]);
    }


    public function update(StoreUserprofileRequest $request, $userid)
    {
        // Get the user instance
        $user = User::with('getProfile')->findOrFail($userid);

        // Avatar ops
        if ($request->has('avatar') and $request->file('avatar') != null) {
            $user->clearMediaCollection('avatars');
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars', 'avatars');  // Second parameters is de defaul filesystem, optional
        }

        if ($request->has('password') && $request->get('password') != '') {
            $user->password = bcrypt($request->get('password'));
        }

        // Filling all the user inputs form
        $user->name = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->api_token = $user->getApiToken();

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
        if (isset($request->all()['phone']))
            $user->getProfile->phone = $request->get('phone');

        // Saving user and user's profile
        $user->getProfile->save();
        $user->save();

        // Logs the actions
        Log::info(LogsMsgs::$msgs['accepted'], [$user->getProfile->username, $userid]);

        return redirect()->route('profile.info', ['userid' => $userid])
            ->with('success', 'User "' . $user->getProfile->username . '" updated successfully');
    }
}
