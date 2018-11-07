<?php

namespace App\Http\Controllers;


use App\Raffle;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Country;


class UserController extends Controller
{

    public function __construct()
    {
        // I think this is not needed because I have this in the route middleware
        $this->middleware('auth');
    }

    public function getProfile($userid)
    {
        $user = User::find($userid)->with('getProfile')->first();
        $raffles = User::find($userid)->getRaffles;
        $rafflesfollowed = User::find($userid)->getRafflesFollowed;
        $rafflesbuyed = User::find($userid)->getRafflesBuyed;
        $tickets_buys = User::find($userid)->getTickets;




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
            'tickets_buys'=>$tickets_buys
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



}
