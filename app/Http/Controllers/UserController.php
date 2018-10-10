<?php

namespace App\Http\Controllers;

use App\DebitCard;
use App\User;
use App\Http\Requests\StoreBillingInfoReques;

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

        return view('user', [
            'user' => $user,
        ]);
    }



}
