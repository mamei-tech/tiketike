<?php

namespace App\Http\Controllers;

use App\Country;
use App\Promo;
use App\RaffleCategory;
use App\RafflePays;
use App\ReferralsBuys;
use App\Repositories\RaffleRepository;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use App\Raffle;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Support\Facades\Log;

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
     * @param $socialNetworkId 0 for none, 1 for facebook, 2 for twitter, 3 for instagram
     * @param Request $request
     * @return mixed
     */
    public function buyTickets($raffleId, $referralId, $socialNetworkId, Request $request)
    {

        $tickets = explode(',',$request->get('tickets')[0]);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $token = $request->get('stripeToken');

        $charge = Charge::create([
            'amount' => $request->get('amountInCents'),
            'currency' => 'usd',
            'description' => 'Tikets buyed from raffle ' . $raffleId,
            'source' => $token,
        ]);
        if ($charge['paid'] == true) {
            $raffle = Raffle::findOrFail($raffleId);
            $raffle->buyTickets(Auth::user(), $tickets, $referralId, $socialNetworkId);
            $raffle_pay = new RafflePays();
            $raffle_pay->raffle_id = $raffleId;
            $raffle_pay->charge_id = $charge['id'];
            $raffle_pay->amount = $charge['amount'];
            $raffle_pay->save();


//            foreach ($tickets as $ticket){
//                $ticket_object = Ticket::where('code', '=', $ticket)->firstOrFail();
//                $ticket_id = $ticket_object->id;
//                $referral_buy = new ReferralsBuys();
//                $referral_buy->comisionist = (int)$referralId;
//                $referral_buy->ticket = $ticket_id;
//                $referral_buy->socialNetwork = $socialNetworkId;
//                $referral_buy->raffle_id = $raffleId;
//                $referral_buy->save();
//            }


            Log::log('INFO', trans('aLogs.referl_buys_tickes'), [
                'user' => Auth::user()->id,
                'raffle' => $raffle->id,
                'tickets' => $request->get('tickets'),
            ]);


            return redirect()->back()->with('200', ['response' => "Your paiment was sent successfully"]);
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
    public function availableTickets($raffleId, Request $request, RaffleRepository $raffleRepository)
    {
        $referido =false;
        $url = explode('/', url()->current());
        $referral_id = $url[count($url) - 2];
        $user = User::findOrFail((int)$referral_id);
        $socialNetwork = $url[count($url) - 1];
        if ($user != Auth::user()){
            $referido = true;
        }
        $countries = Country::all();
        $suggested = $raffleRepository->getSuggested();
        $raffle = Raffle::find($raffleId);
        $promos = Promo::getSomePromos();
        $mainPromos = Promo::where('type', 1)->where('status', 1)->get();
        $categories = RaffleCategory::all();
        return view('raffle', compact('referral_id', 'socialNetwork', 'referido', 'countries', 'suggested', 'raffle', 'mainPromos', 'categories', 'raffleId', 'promos'));
    }


    /**
     * Display available tickets.
     *
     * @param $raffleId         Raffle id.
     * @param Request $request
     * @param RaffleRepository $raffleRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function availableTicketsByReferral($raffleId, $referralId, $socialNetwork, RaffleRepository $raffleRepository)
    {
        $countries = Country::all();
        $suggested = $raffleRepository->getSuggested();
        $raffle = Raffle::find($raffleId);
        $promos = Promo::where('type', 1)->where('status', 1)->get();
        $categories = RaffleCategory::all();
        return view('raffle', compact('countries', 'suggested', 'raffle', 'promos', 'categories', 'raffleId', 'referralId', 'socialNetwork'));
    }
}
