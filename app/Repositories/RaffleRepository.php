<?php

namespace App\Repositories;

use App\Raffle;
use function foo\func;
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
            $raffles = Raffle::with(['getTickets', 'getFollowers', 'getOwner'])
                ->whereHas('getFollowers', function (Builder $q) use ($user) {
                    $q->where('user_id', '<>', $user);
                })
                ->whereHas('getTickets', function (Builder $q) use ($user) {
                    $q->where('buyer', '<>', $user);
                })
                ->where('owner', '<>', $user)
                ->limit(3)
                ->orderBy('activation_date', 'DESC')
                ->get();
            return $raffles;
        } else {
            return Raffle::where('activation_date', '<>', null)->orderBy('activation_date', 'DESC')->limit(3)->get();
        }
    }

    public function getRafflesByCategory($category, $filter = null)
    {
        if ($filter != null) {
            if ($filter == 'percent') {
                return Raffle::with('getCategory')
                    ->whereHas('getCategory', function (Builder $q) use ($category) {
                        $q->where('category', $category);
                    })
                    ->where('progress','<',100)
                    ->orderBy('progress', 'DESC')
                    ->paginate(10);
            } else {
                return Raffle::with('getCategory')
                    ->whereHas('getCategory', function (Builder $q) use ($category) {
                        $q->where('category', $category);
                    })
                    ->where('progress','<',100)
                    ->orderBy('price', 'DESC')
                    ->paginate(10);
            }
        } else {
            return Raffle::with('getCategory')
                ->whereHas('getCategory', function (Builder $q) use ($category) {
                    $q->where('category', $category);
                })
                ->where('progress','<',100)
                ->paginate(10);
        }
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
                $q->where('status', $status);
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
                $q->where('status', $status);
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
                $q->where('status', $status);
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
    public function almostsoldraffles()
    {

        return Raffle::join('rafflestatus', 'raffles.status', '=', 'rafflestatus.id')
            ->join('tickets', 'raffles.id', '=', 'tickets.raffle')
            ->select(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                'raffles.tickets_price',
                DB::raw('ABS((sum(tickets.sold) * 100) / count(tickets.id)) as progress'),
                'raffles.activation_date')
            ->where('rafflestatus.status', 'Published')
            ->groupBy(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                'raffles.tickets_price',
                'raffles.activation_date'
            )
            ->orderBy('progress', 'DESC')
            ->having('progress', '<', 100)
            ->having('progress', '>', 79)
            ->take(8)
            ->get();
    }

    public function getAllProgress()
    {
        return Raffle::join('tickets', 'raffles.id', '=', 'tickets.raffle')
            ->select(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                'raffles.tickets_price',
                DB::raw('ABS((sum(tickets.sold) * 100) / count(tickets.id)) as progress'),
                'raffles.activation_date')
            ->groupBy(
                'raffles.id',
                'raffles.title',
                'raffles.price',
                'raffles.profit',
                'raffles.tickets_price',
                'raffles.activation_date'
            )
            ->get();
    }
}
