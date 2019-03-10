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
        $country = $user->getProfile->getCity->getCountry->name;
        $createdraffles = count($user->getRaffles);
        $winnedRaffles = count($user->WinnedRaffles());
        $soldtickets = $user->getSoldTicketsCount();
        $route = route('profile.info',['userid'=>$id]);
        return new Response([
            'route'=>$route,
            'name'=>$name,
            'country'=>$country,
            'created_raffles' => $createdraffles,
            'winned_raffles' => $winnedRaffles,
            'sold_tickets' => $soldtickets
        ],Response::HTTP_OK);
    }

    public function getcity($city_id)
    {
            $country    = Country::findOrFail($city_id);
            $cities     = $country->cities()->get();

        return new Response([
            'cities'    =>  $cities,
        ],Response::HTTP_OK);
    }
}
