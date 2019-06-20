<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\CustomRules\StrongEvalR;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        return [
            'id' => 'same:'.Auth::user()->id,
            'email' => 'required|email|max:60',
            'birthdate' => 'nullable|date_format:Y-m-d|max:10',
            'gender' => 'required',
            'languaje'=> 'required',
            'phone'=> 'required',
            'firstname'=> 'required|string|min:3|max:30',
            'lastname'=> 'required|string|min:6|max:30',
            'password' => ['nullable', 'string', 'confirmed', new StrongEvalR()],
            'address'=> 'required|string|min:12|max:60',
            'country' => 'required|not_in:0|min:1|exists:world_countries,id',
            'city' => 'required|not_in:0|min:1|exists:world_cities,id',
            'zipcode' => 'nullable|integer|between:999,9999999999',
            'bio' => 'nullable|max:116',
            'avatar' => 'nullable|mimes:jpeg,png|dimensions:max_width=1920,max_height=1080|between:1,4096',
        ];
    }
}
