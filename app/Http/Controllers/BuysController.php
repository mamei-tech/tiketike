<?php

namespace App\Http\Controllers;

use App\Promo;
use App\Repositories\RaffleRepository;
use Illuminate\Http\Request;
use App\Raffle;
use App\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

abstract class BuysController extends Controller
{
    private $raffleRepository;

    /**
     * BuysController constructor.
     * @param $raffleRepository
     */
    public function __construct(RaffleRepository $raffleRepository)
    {
        $this->raffleRepository = $raffleRepository;
    }


    /**
     * Display available tickets.
     *
     * @param $raffleId         Raffle id.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function availableTickets($raffleId, Request $request)
    {
        $user = Auth::user()->id;
        $suggested = $this->raffleRepository->getSuggested();
        $raffle = Raffle::find($raffleId);
        $promos = Promo::where('type',1)->where('status',1)->get();
        return view('raffle', ['raffleId' => $raffleId,'promos'=>$promos, 'tickets' => $tickets, 'url' => $request->fullUrl(), 'raffle' => $raffle,'suggested' => $suggested]);
    }
}
