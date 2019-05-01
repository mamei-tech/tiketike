<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\StoreUserprofileRequest;
use App\Http\Resources\RaffleResource;
use App\Promo;
use App\Repositories\RaffleRepository;
use App\User;
use App\UserProfile;
use Illuminate\Database\Eloquent\Builder;
use App\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $current = User::findOrFail((int)$userid);
        $raffles =$current->getRaffles;
        $rafflesBuyed = $current->getRafflesBuyed;
        $currentProfile = $current->getProfile;
        $rafflesCount = count($current->getRaffles);
        $winnedRaffles = $current->WinnedRaffles();
        $sharedRaffles = count($current->getReferralsBuys->groupBy('raffle_id'));
        $soldTickets = $current->getSoldTicketsCount();
        $suggested = $this->raffleRepository->getSuggested();
        $balance = $currentProfile->balance;
        $raffleMoney = $current->getRaffleMoney();
        $raferralMoney = $current->getReferralsMoney();
        $promos = Promo::getSomePromos();
        $avatar = $current->getMedia('avatars')->first()->getUrl();
        $country = $currentProfile->getCity->country->name;
        return view('user', compact(
            'current',
            'currentProfile',
            'rafflesCount',
            'winnedRaffles',
            'sharedRaffles',
            'soldTickets',
            'suggested',
            'balance',
            'raffleMoney',
            'raferralMoney',
            'promos',
            'avatar',
            'country',
            'raffles',
            'rafflesBuyed'
        ));
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

        $userProfile = null;
        if ($user->getProfile != null)
            $userProfile = $user->getProfile;
        else {
            $userProfile = new UserProfile();
            $userProfile->user = $user->id;
        }

        if (isset($request->all()['birthdate']))
            $userProfile->birthdate = date('Y-m-d', strtotime($request->get('birthdate')));
        if (isset($request->all()['gender']))
            $userProfile->gender = $request->get('gender');
        if (isset($request->all()['city']))
            $userProfile->city = $request->get('city');
        if (isset($request->all()['languaje']))
            $userProfile->langcode = $request->get('languaje');
        if (isset($request->all()['bio']))
            $userProfile->bio = $request->get('bio');
        if (isset($request->all()['address']))
            $userProfile->addrss = $request->get('address');
        if (isset($request->all()['zipcode']))
            $userProfile->zipcode = $request->get('zipcode');
        if (isset($request->all()['phone']))
            $userProfile->phone = $request->get('phone');
        $userProfile->username = $request->get('firstname');

        // Saving user and user's profile
        $userProfile->save();
        $user->save();

        // Logs the actions
        Log::log('INFO', trans('aLogs.adm_araffle_deleted'), [
            'user' => Auth::user()->id,
            'request'   => $request->all(),
        ]);

        return redirect()->route('profile.info', ['userid' => $userid])
            ->with('success', 'User "' . $user->getProfile->username . '" updated successfully');
    }

    public function follow($id)
    {
        $user = User::findOrFail($id);
        $user->getFollowers()->syncWithoutDetaching(Auth::user());

        Log::log('INFO', trans('aLogs.new_fallower'), [
            'user'    => $user->id,
            'follower' => Auth::user()->id,
        ]);

        return redirect()->back()
            ->with('success', 'Raffle follow successfully');
    }
}
