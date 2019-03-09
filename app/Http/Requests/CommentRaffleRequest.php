<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRaffleRequest extends FormRequest
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
            'text' => 'required',
            'parent_id'=>'exists:comments,id',

            //TODO Select Validation is missing
        ];
    }

    public function messages()
    {
        return [
            'text.required' => 'El :attribute es obligatorio.',
        ];
    }
}
