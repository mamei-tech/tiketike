<?php

namespace App\Http\Controllers;

use App\Country;
use App\Promo;
use App\Raffle;
use App\RaffleCategory;
use App\RafflePays;
use App\Repositories\RaffleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Log;


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
        $tickets = explode(',',$request->get('tickets')[0]);
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
            $raffle->buyTickets(Auth::user(), $tickets);
            $raffle_pay = new RafflePays();
            $raffle_pay->raffle_id = $raffleId;
            $raffle_pay->charge_id = $charge['id'];
            $raffle_pay->amount = $charge['amount'];
            $raffle_pay->save();

            Log::log('INFO', trans('aLogs.driect_buys_tickes'),
                [
                    'user'      => Auth::user()->id,
                    'tickets'   => $request->get('tickets'),
                ]);

            return redirect()->back()->with('200',['response' => trans('view.payments_done')]);
        }

        return redirect($request->fullUrl(), 303);
    }


    /**
     * Display available tickets.
     *
     * @param $raffleId         Raffle id.
     * @param Request $request
     * @param RaffleRepository $raffleRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function availableTickets($raffleId, Request $request,RaffleRepository $raffleRepository)
    {
        $countries = Country::all();
        $suggested = $raffleRepository->getSuggested();
        $raffle = Raffle::find($raffleId);
        $promos = Promo::getSomePromos();
        $mainPromos = Promo::where('type',1)->where('status',1)->get();
        $categories = RaffleCategory::all();
        $referido = false;
        return view('raffle', compact('referido','countries','suggested','raffle','mainPromos','categories','raffleId','promos'));
    }
}
