<?php

namespace App\Http\Requests;

use App\Http\Requests\CustomRules\ChknameEditPromo;
use Illuminate\Foundation\Http\FormRequest;

class EditPromoRequest extends FormRequest
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
//            'name'          => 'required|string|max:255|unique:promos,name',
            'name'          => 'required|string|max:255',
            'expdate'       => 'required|date|after:today',
            'type'          => 'integer|between:0,1',
            'status'        => 'integer|between:0,1',
            'image'         => 'required|mimes:jpeg,png|between:1,4096|unique:promos,image',
            'alternative'   => 'required|string|max:200',
            'website'       => 'required|string|max:60',
        ];
    }
}
