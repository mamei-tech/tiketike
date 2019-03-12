<?php

namespace App\Http\Requests;

use App\Http\Requests\CustomRules\CustomValidateRaffle;
use App\Http\Requests\CustomRules\RaffleShuffled;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ConfirmRaffle extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'wconfirmation' => 'required',
            'oconfirmation '=> 'required',
            'user' => 'required|same:'.Auth::user()->id.'|'.[new CustomValidateRaffle('raffleId')],
            'raffleId' => 'required|'.[new RaffleShuffled()]
        ];
    }
}
