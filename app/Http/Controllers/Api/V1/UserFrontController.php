<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ChkRPublishRequest;
use App\Http\TkTk\Cfg\CfgRaffles;
use App\Raffle;
use App\Repositories\RaffleRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserFrontController extends ApiController
{
    public function getUser(Request $request)
    {
        $id = $request->get('userid');
        $user = User::find($id);
        $createdraffles = count($user->getRaffles);
        $winnedRaffles = count($user->WinnedRaffles());
        $soldtickets = $user->getSoldTicketsCount();
        return new Response([
            'created_raffles' => $createdraffles,
            'winned_raffles' => $winnedRaffles,
            'sold_tickets' => $soldtickets
        ],Response::HTTP_OK);
    }
}
