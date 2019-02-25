<?php

namespace App\Http\Controllers\Api\V1;

use App\ActiveUsers;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Response;

class ActiveUsersController extends ApiController
{
    public function activeUsers() {
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
}
