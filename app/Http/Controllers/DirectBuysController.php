<?php

namespace App\Http\Controllers;

use App\Raffle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Charge;

class DirectBuysController extends BuysController
{
    public function __construct()
    {
        $this->middleware('permission:buys_tickets')->only(['buyTickets']);
    }

    /**
     * Process a tickets buy.
     *
     * @param $raffleId         - Tickets's raffle id.
     * @param Request $request  - Data with tickets ids.
     * @return mixed
     */
    public function buyTickets($raffleId, Request $request)
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

            $raffle->buyTickets(Auth::user(), $request->get('ticketsarray'));
            return redirect()->back()->with('200',['response' => "Your paiment was sent successfully"]);
        }

        return redirect($request->fullUrl(), 303);
    }
}
