<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Raffle;
use Illuminate\Support\Facades\Auth;

class ReferralsBuysController extends BuysController
{
    /**
     * Process a tickets buy.
     *
     * @param $raffleId - Tickets's raffle id.
     * @param $referralId - Referral id.
     * @param $socialNetworkId  0 for none, 1 for facebook, 2 for twitter, 3 for instagram
     * @param Request $request
     * @return mixed
     */
    public function buyTickets($raffleId, $referralId, $socialNetworkId, Request $request)
    {
        $raffle = Raffle::findOrFail($raffleId);

        $raffle->buyTickets(Auth::user(), $request->availabletickets, $referralId, $socialNetworkId);

        return redirect($request->fullUrl(), 303);
    }
}
