<?php

namespace App\Http\Controllers\Api\V1;

use App\ActiveUsers;
use App\Http\Controllers\Api\ApiController;
use App\Raffle;
use Illuminate\Http\Response;

class DashboardController extends ApiController
{
    public function activeUsers() {

        ActiveUsers::updateActiveUsers();

        $trackedActiveUsers = ActiveUsers::all(); //Allways are 30 items
        $male_users     = [];
        $female_users   = [];
        for ($i = count($trackedActiveUsers) - 1; $i >= 0; $i--) {
            array_push($male_users, $trackedActiveUsers[$i]->male_count);
            array_push($female_users, $trackedActiveUsers[$i]->female_count);
        }
        return $this->respond([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            // Payload
            'male_users'    => $male_users,
            'female_users'  => $female_users,
        ]);
    }

    public function publishedRaffles() {
        return $this->respond([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            // Payload
            'publishedRaffles' => $this->activatedRafflesByMonth(),
        ]);
    }

    function activatedRafflesByMonth() {
        $currenYear = date('Y');
        return [
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 1)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 2)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 3)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 4)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 5)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 6)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 7)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 8)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 9)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 10)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 11)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 12)->get())
        ];
    }
}
