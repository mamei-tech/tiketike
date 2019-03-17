<?php

namespace App\Http\Controllers\Api\V1;

use App\Country;
use App\Http\Controllers\Api\ApiController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserFrontController extends ApiController
{
    public function getUser(Request $request)
    {
        $id = $request->get('userid');
        $user = User::with('getProfile')->findOrFail($id);
        $name = $user->name.' '.$user->lastname;
        $country = $user->getProfile->getCity->country->name;
        $createdraffles = count($user->getRaffles);
        $winnedRaffles = count($user->WinnedRaffles());
        $soldtickets = $user->getSoldTicketsCount();
        $route = route('profile.info',['userid'=>$id]);
        $shared_raffles = count($user->getReferralsBuys->groupBy('raffle_id'));
        return new Response([
            'route'=>$route,
            'name'=>$name,
            'country'=>$country,
            'created_raffles' => $createdraffles,
            'winned_raffles' => $winnedRaffles,
            'sold_tickets' => $soldtickets,
            'shared_raffles' => $shared_raffles
        ],Response::HTTP_OK);
    }

    public function getcity(Request $request, $city_id, $user_id)
    {
            $country    = Country::findOrFail($city_id);
            $user       = User::findOrFail($user_id);

            $cities     = $country->cities()->get();
            $selected   = $user->getProfile->getCity->id;

        return new Response([
            'cities'    => $cities,
            'selected'  => $selected,
        ],Response::HTTP_OK);
    }
}
