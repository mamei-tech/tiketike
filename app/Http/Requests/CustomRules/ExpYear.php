<?php

namespace App\Http\Requests\CustomRules;

use Illuminate\Contracts\Validation\Rule;

class ExpYear implements Rule
{
    // TODO Use translation thisss
    protected $message = "The expiration year don't exist anymore.";

    public function passes($attribute, $year)
    {
        if (strlen($year) < 4 || strlen($year) > 4) {
            $this->message = "The year must have exactly four character.";
            return false;
        }

        else if (!preg_match("#(20[1-3][0-9])#", $year)) {
            $this->message = "You most enter a valid year using YYYY format.";
            return false;
        }

        else if ($year <= date("Y", strtotime("-1 year"))) {
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