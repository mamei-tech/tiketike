<?php

namespace App\Http\Requests\CustomRules;
use Illuminate\Contracts\Validation\Rule;


class ExpMonth implements Rule
{
    protected $message = '';

    /**
     * ExpMonth constructor.
     * @param string $message
     */
    public function __construct()
    {
        $this->message = trans('validation.expiration_date');
    }


    public function passes($attribute, $year)
    {
        if(strlen($year) < 2 || strlen($year) > 2)
        {
            $this->message = trans('validation.month_chars');
            return false;
        }

        else if (!preg_match("#(0[1-9])|([1-9][0-2])#", $year)) {
            $this->message = trans('validation.month_format');
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