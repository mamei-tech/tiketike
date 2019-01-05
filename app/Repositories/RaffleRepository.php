<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2/1/2019
 * Time: 02:27
 */

namespace App\Repositories;


use App\Raffle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class RaffleRepository
{
    public function getSuggested()
    {
        if (Auth::user() != null) {
            $user = Auth::user()->id;
            $raffles = Raffle::with(['getTickets', 'getFollowers', 'getOwner'])
                ->whereHas('getTickets', function (Builder $q) use ($user) {
                    $q->where('buyer', '<>', $user);
                    $q->groupBy('raffle');
                })
                ->whereHas('getFollowers', function (Builder $q) use ($user) {
                    $q->where('user_id', '<>', $user);
                    $q->groupBy('raffle_id');
                })
                ->where('owner', '<>', $user)
                ->limit(3)
                ->get();
            return $raffles;
        }else{
            return Raffle::orderBy('updated_at','DESC')->limit(3)->get();
        }
    }
}