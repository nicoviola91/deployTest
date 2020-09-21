<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UserRequest extends FormRequest
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
            'name' => 'max:150|required',
            'apellido' => 'max:150|required',
            'dni' => 'min:6|digits_between:6,10|required|numeric',
            'email' => 'min:6|max:100|required|unique:users',
            'password' => 'min:8|max:250|required'
        ];
    }
}
