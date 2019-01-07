<?php

namespace App\Http\Requests\CustomRules;
use Illuminate\Contracts\Validation\Rule;


class StrongEvalR implements Rule
{
    // TODO Use translation this
    protected $message = "Something is wrong with the password. Please re-type it";

    public function passes($attribute, $year)
    {
        if(strlen($year) < 8)
        {
            $this->message = "Password is too short";
            return false;
        }

        else if (!preg_match("#[0-9]+#", $year)) {
            $this->message = "Password must include at least one number";
            return false;
        }
        /* I don't know if necesary */
//        else if (!preg_match("#[A-Z]+#", $pswd)) {
//            $this->message = "Password must include at least one capital letter";
//            return false;
//        }
        else if (!preg_match("#[a-z]+#", $year)) {
            $this->message = "Password must include at least one letter";
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