<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Raffle;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Stripe;

class ReferralsBuysController extends BuysController
{
    public function __construct()
    {
        $this->middleware('permission:referrals_buys_tickets')->only(['buyTickets']);
    }

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
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $token = $request->get('stripeToken');
        $charge = Charge::create([
            'amount' => $request->get('amountInCents'),
            'currency' => 'usd',
            'description' => 'Tikets buyed from raffle '.$raffleId,
            'source' => $token,
        ]);
        if ($charge['paid'] == true) {
            $raffle = Raffle::findOrFail($raffleId);
            $raffle->buyTickets(Auth::user(), $request->get('tickets'),$referralId, $socialNetworkId);
            $raffle_pay = new RafflePays();
            $raffle_pay->raffle_id = $raffleId;
            $raffle_pay->charge_id = $charge['id'];
            $raffle_pay->amount = $charge['amount'];
            $raffle_pay->save();
            return redirect()->back()->with('200',['response' => "Your paiment was sent successfully"]);
        }

        return redirect($request->fullUrl(), 303);
    }
}
