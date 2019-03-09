<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePromoRequest extends FormRequest
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
            'name'          => 'required|string|max:255|unique:promos,name',
            'expdate'       => 'required|date|after:today',
            'type'          => 'integer|between:0,1',
            'status'        => 'integer|between:0,1',
            'client'        => 'required|not_in:0|min:1|exists:promoclients,id',
            'image'         => 'required|mimes:jpeg,png|between:1,4096|unique:promos,image',
            'alternative'   => 'required|string|max:200',
            'website'       => 'required|string|max:60',
        ];
    }
}
