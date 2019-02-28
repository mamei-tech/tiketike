<?php
/**
 * Created by PhpStorm.
 * User: YBMDEV
 * Date: 25/02/2019
 * Time: 14:42
 */

namespace App\Repositories;

use App\ActiveUsers;
use App\User;

class ActiveUsersRepository
{
    public static function markUserAsLogged($user) {
        $user->logged = true;
        $user->save();
    }

    public static function markUserAsUnlogged($user) {
        $user->logged = false;
        $user->save();
    }
}