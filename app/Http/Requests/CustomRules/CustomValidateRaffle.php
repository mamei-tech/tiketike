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
use Illuminate\Support\Facades\Auth;


class CustomValidateRaffle implements Rule
{
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
        $this->message = trans('validation.user_not_allowed');
    }

    public function passes($attribute, $year)
    {
        if ($year != Auth::user()->id)
            return false;
        $confirmation = RaffleConfirmation::where('raffle_id',$this->raffle)->first();
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