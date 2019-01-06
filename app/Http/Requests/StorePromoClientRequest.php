<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePromoClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO: Do the correct this here, right now i don't know what is that for
        //return false;
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
            'name'          => 'required|string|max:30',
            'email'         => 'required|string|max:35|email',
            'contact'       => 'required|string',    // TODO Maybe improve this validation rule with a custom one
        ];
    }
}
