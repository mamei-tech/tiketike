<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\CustomRules\StrongEvalR;

class StoreUserprofileRequest extends FormRequest
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
        /* TODO Set what field are required, setup here, in the view and in the migration and model */
        return [
            'email' => 'required|email|max:60',
            'birthdate' => 'date_format:d-m-Y|max:10',              // TODO add limits to validation, not pass date allowed
            'gender' => 'required|not_in:0|min:1',                  // TODO check is Male or Female
            'languaje'=> 'required|not_in:0|min:1',
            'firstname'=> 'required|string|min:3|max:30',
            'lastname'=> 'required|string|min:6|max:30',
//            'password' => ['nullable', 'string', 'confirmed', new StrongEvalR()],
            'address'=> 'required|string|min:12|max:60',
            'country' => 'required|not_in:0|min:1|exists:countries,id',
            'city' => 'required|not_in:0|min:1|exists:cities,id',
            'zipcode' => 'nullable|integer|between:999,9999999999',
            'bio' => 'nullable|max:116',
            'avatar' => 'nullable|mimes:jpeg,png|dimensions:max_width=800,max_height=800|between:1,4096',
        ];
    }
}
