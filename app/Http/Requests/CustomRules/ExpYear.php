<?php

namespace App\Http\Requests\CustomRules;

use Illuminate\Contracts\Validation\Rule;

class ExpYear implements Rule
{
    protected $message = "";

    /**
     * ExpYear constructor.
     * @param string $message
     */
    public function __construct()
    {
        $this->message = trans('validation.year_exist');
    }


    public function passes($attribute, $year)
    {
        if (strlen($year) < 4 || strlen($year) > 4) {
            $this->message = trans('validation.year_chars');
            return false;
        }

        else if (!preg_match("#(20[1-3][0-9])#", $year)) {
            $this->message = trans('validation.year_format');
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