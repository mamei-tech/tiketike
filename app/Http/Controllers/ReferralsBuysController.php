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
     * @param $raffleId             - Tickets's raffle id.
     * @param $referralId           - Referral id.
     * @param Request               - $request data with tickets ids.
     * @return mixed
     */
    public function buyTickets($raffleId, $referralId, Request $request)
    {
        $raffle = Raffle::findOrFail($raffleId);

        $raffle->buyTickets(Auth::user(), $request->availabletickets, $referralId);

        return redirect($request->fullUrl(), 303);
    }
}
