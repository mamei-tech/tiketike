<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 3/12/2019
 * Time: 8:50 AM
 */

namespace App\Http\Requests\CustomRules;

use App\Raffle;
use Illuminate\Contracts\Validation\Rule;

class RaffleShuffled implements Rule
{
    //TODO set custom message with internationalization
    private $message;

    /**
     * RaffleShufled constructor.
     */
    public function __construct()
    {
    }

    public function passes($attribute, $year)
    {
        $raffle = Raffle::findOrFail($year);
        if ($raffle->status == 5)
            return true;
        else
            return false;
    }

    public function message()
    {
        // return ':attribute needs more cowbell!';
        return $this->message;
    }
}