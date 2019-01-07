<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChkRPublishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
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
            'id'            => 'exists:raffles,id',
            'profit'        => 'required|integer|between:0,200',
            'commissions'   => 'required|integer|between:0,50',
            'criteria'      => ['required', 'regex:/^(tcount)$|^(tprice)$/us'],
            'tkcount'       => 'numeric',
            'tprice'        => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'criteria.regex' => 'Wrong criteria was given',
        ];
    }
}
