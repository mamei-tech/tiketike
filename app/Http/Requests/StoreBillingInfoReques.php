<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\CustomRules\ExpMonth;
use App\Http\Requests\CustomRules\ExpYear;

class StoreBillingInfoReques extends FormRequest
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
            "accnumber"         =>  'required|integer|digits_between:14,16',
            "cvv"               =>  'nullable|integer',
            "expdate_month"     =>  ['required', 'between:01,12', new ExpMonth()],
            "expdate_year"      =>  ['required', new ExpYear()]
        ];
    }
}
