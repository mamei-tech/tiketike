<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Raffle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\User;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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

        Log::log('INFO', trans('aLogs.dashboard_show').' - '.Auth::user()->id);

        return view('admin.index',
            [
                'li_activeDash' => 'active',
                'netGain' => round(Raffle::rafflesNetGain(), 2),
                'usersCount' => User::usersCount(),
                'sharedRaffles' => $sharedRaffles,
            ]);
    }
}

