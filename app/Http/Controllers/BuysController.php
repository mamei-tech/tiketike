<?php

namespace App\Http\Controllers;

use App\Promo;
use Illuminate\Http\Request;
use App\Raffle;
use App\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user()->id;
        $suggested = Raffle::with(['getTickets','getFollowers','getOwner'])
            ->whereDoesntHave('getFollowers',function (Builder $q) use ($user) {
                $q->where('user_id','<>',$user);
            })
            ->whereDoesntHave('getTickets',function (Builder $q) use ($user) {
                $q->where('buyer','<>',$user);
            })
            ->where('owner','<>',$user)
            ->limit(3)
            ->get();
        $raffle = Raffle::find($raffleId);
        $promos = Promo::where('type',1)->where('status',1)->get();
        if ($raffle == null)
        {
            //TODO return some error view
            echo "UNKNOW RAFFLE";
            die();
        }

        $tickets = Ticket::where('tickets.raffle', $raffleId)->where('tickets.sold', false)->get();
        return view('raffle', ['raffleId' => $raffleId,'promos'=>$promos, 'tickets' => $tickets, 'url' => $request->fullUrl(), 'raffle' => $raffle,'suggested' => $suggested]);
    }
}
