<?php

namespace App\Repositories;

use App\Raffle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class RaffleRepository
{
    public function getSuggested()
    {
        if (Auth::user() != null) {
            $user = Auth::user()->id;
            $raffles = Raffle::with(['getTickets','getFollowers','getOwner'])
                ->whereDoesntHave('getFollowers',function (Builder $q) use ($user) {
                    $q->where('user_id','<>',$user);
                })
                ->whereDoesntHave('getTickets',function (Builder $q) use ($user) {
                    $q->where('buyer','<>',$user);
                })
                ->where('owner','<>',$user)
                ->limit(3)
//                ->orderBy('activation_date','DESC')
                ->get();
            return $raffles;
        }else{
            return Raffle::orderBy('updated_at','DESC')->limit(3)->get();
        }
    }

    public function getRaflesByCategory($category)
    {
        $raffles = Raffle::with('getCategory')
            ->whereHas('getCategory', function (Builder $q) use ($category) {
                $q->where('category', $category);
            })
            ->orderBy('updated_at')
            ->paginate(3);
        return $raffles;
    }

    /**
     * Retrieve all the Anulled raffles
     *
     * @return mixed
     */
    public function getAnulleddRaffles()
    {
        return DB::table('raffles')
            ->join('rafflestatus', 'raffles.status', '=', 'rafflestatus.id')
            ->join('tickets', 'raffles.id', '=', 'tickets.raffle')
            ->select(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                DB::raw('sum(tickets.sold) as solds_tickets'),
                'raffles.tickets_count',
                'raffles.activation_date')
            ->where('rafflestatus.status', 'Cancelled')
            ->groupBy(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                'raffles.tickets_count',
                'raffles.activation_date'
            )
            ->get();
    }

    /**
     * Retrieve all the Anulled raffles
     *
     * @return mixed
     */
    public function getTenAnulleddRaffles()
    {
        return DB::table('raffles')
            ->join('rafflestatus', 'raffles.status', '=', 'rafflestatus.id')
            ->join('tickets', 'raffles.id', '=', 'tickets.raffle')
            ->select(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                DB::raw('sum(tickets.sold) as solds_tickets'),
                'raffles.tickets_count',
                'raffles.activation_date')
            ->where('rafflestatus.status', 'Cancelled')
            ->groupBy(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                'raffles.tickets_count',
                'raffles.activation_date'
            )
            ->paginate(10);
    }

    /**
     * Retrieve all the Published raffles
     *
     * @return mixed
     */
    public function getTenPublishedRaffles()
    {
        $status = "Published";
        $raffles = Raffle::with('getStatus')
            ->whereHas('getStatus', function (Builder $q) use ($status) {
                $q->where('status',$status);
            })
            ->paginate(10);
        return $raffles;
    }

    /**
     * Retrieve all the Published raffles
     *
     * @return mixed
     */
    public function getPublishedRaffles()
    {
        $status = "Published";
        $raffles = Raffle::with('getStatus')
            ->whereHas('getStatus', function (Builder $q) use ($status) {
                $q->where('status',$status);
            })
            ->get();
        return $raffles;
    }

    /**
     * Retrieve all the Published raffles
     *
     * @return mixed
     */
    public function getFollowsRaffles()
    {
        $status = "Published";
        $raffles = Raffle::with('getStatus')
            ->whereHas('getStatus', function (Builder $q) use ($status) {
                $q->where('status',$status);
            })
            ->paginate(10);
        return $raffles;
    }

    /**
     * Retrieve all the unpublished raffles
     *
     * @return mixed
     */
    public function getTenUnpublishedRaffles()
    {
        return DB::table('raffles')
            ->join('rafflestatus', 'raffles.status', '=', 'rafflestatus.id')
            ->select(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit'
            )
            ->where('rafflestatus.status', 'Unpublished')
            ->groupBy(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit'
            )
            ->paginate(10);
    }

    /**
     * Retrieve all the unpublished raffles
     *
     * @return mixed
     */
    public function getUnpublishedRaffles()
    {
        return DB::table('raffles')
            ->join('rafflestatus', 'raffles.status', '=', 'rafflestatus.id')
            ->select(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit'
            )
            ->where('rafflestatus.status', 'Unpublished')
            ->groupBy(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit'
            )
            ->get();
    }

    /**
     * Retrieve the raffles that are almost sold, all his tickets I mean.
     *
     * @return Collection
     */
    public function almostsoldraffles() {

        $rafflesdbquery = Raffle::join('rafflestatus', 'raffles.status', '=', 'rafflestatus.id')
            ->join('tickets', 'raffles.id', '=', 'tickets.raffle')
            ->select(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                'raffles.tickets_price',
                DB::raw('sum(tickets.sold) as solds_tickets'),
                'raffles.tickets_count',
                'raffles.activation_date')
            ->where('rafflestatus.status', 'Published')
            ->groupBy(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                'raffles.tickets_price',
                'raffles.tickets_count',
                'raffles.activation_date'

            )
            ->take(3)                  // Limit the query to 35 raffles
            ->get();

        $almostsoldraffles = new Collection();

        $break = 0;
        foreach ($rafflesdbquery as $key => $raffle)
        {
            // Checking if the progress of the raffle is higher than 80 %
            $progres = ($raffle->solds_tickets * 100) / $raffle->tickets_count;
            if ($progres >= 80)
                $almostsoldraffles->add($raffle);

            // Braking the habit
            if ($break == 23)                                   // 0 ~ 23  count 24
                break;

            $break++;
        }

        return $almostsoldraffles;
    }


    public function getProgress()
    {
        if($this->tickets_count == 0)
            return 0;
        $solds_tickets = $this->getTicketsSold();
        $progress = ($solds_tickets * 100) / $this->tickets_count;
        return $progress;

    }

    public function getTicketsSold($id)
    {
        $tickets = Raffle::join('tickets', 'raffles.id', '=', 'tickets.raffle')
            ->select('tickets.id')
            ->where('raffles.id',$id)
            ->where('tickets.sold',1)
            ->count();
        return $tickets;
    }
}