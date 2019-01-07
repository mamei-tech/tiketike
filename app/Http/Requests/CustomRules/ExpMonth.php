<?php

namespace App\Http\Requests\CustomRules;
use Illuminate\Contracts\Validation\Rule;


class ExpMonth implements Rule
{
    // TODO Use translation this
    protected $message = "The expdate month must be between 01 and 12.";


    public function passes($attribute, $year)
    {
        if(strlen($year) < 2 || strlen($year) > 2)
        {
            $this->message = "The month must have only two character.";
            return false;
        }

        else if (!preg_match("#(0[1-9])|([1-9][0-2])#", $year)) {
            $this->message = "Enter a correct month number. Use the month in the format MM.";
            return false;
        }
        else {
            return true;
        }
    }

    public function message()
    {
        // return ':attribute needs more cowbell!';
        return $this->message;
    }
}