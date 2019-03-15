<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;
use App\Raffle;
use App\RaffleStatus;
use App\ReferralsBuys;
use App\Ticket;
use App\User;
use App\UserProfile;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('permission:enter_admin') ->  only(['index']);
        $this->middleware('auth');
    }

    /**
     * Show the admin section dashboard page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sharedRaffles = Raffle::sharedRaffles();
        return view('admin.index',
            [
                'li_activeDash' => 'active',
                'netGain' => round(Raffle::rafflesNetGain(), 2),
                'usersCount' => User::usersCount(),
                'sharedRaffles' => $sharedRaffles,
            ]);
    }
}

