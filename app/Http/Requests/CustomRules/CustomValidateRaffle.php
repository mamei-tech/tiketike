<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 3/12/2019
 * Time: 8:26 AM
 */

namespace App\Http\Requests\CustomRules;
use App\RaffleConfirmation;
use Illuminate\Contracts\Validation\Rule;


class CustomValidateRaffle implements Rule
{
    //TODO set custom message with internationalization
    private $raffle;
    private $user;
    private $message;

    /**
     * CustomValidateRaffle constructor.
     * @param $raffle
     * @param $user
     */
    public function __construct($raffle)
    {
        $this->raffle = $raffle;
    }

    public function passes($attribute, $year)
    {
        $confirmation = RaffleConfirmation::where('raffleId',$this->raffle)->first();
        if($year == $confirmation->owner_id or $year == $confirmation->winner_id)
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