<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Raffle;
use App\Ticket;

abstract class BuysController extends Controller
{
    /**
     * Display available tickets.
     *
     * @param $raffleId         Raffle id.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function availableTickets($raffleId, Request $request)
    {
        $raffle = Raffle::find($raffleId);
        if ($raffle == null)
        {
            //TODO return some error view
            echo "UNKNOW RAFFLE";
            die();
        }

        $tickets = Ticket::where('tickets.raffle', $raffleId)->where('tickets.sold', false)->get();
        return view('raffle', ['raffleId' => $raffleId, 'tickets' => $tickets, 'url' => $request->fullUrl(), 'raffle' => $raffle]);
    }
}
