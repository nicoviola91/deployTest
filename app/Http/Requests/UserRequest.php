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
            'name' => 'min:1|max:100|required',
            'apellido' => 'min:1|max:100|required',
            'dni' => 'min:7|max:100|required',
            'email' => 'min:6|max:100|required|unique:users',
            'password' => 'min:6|max:250|required'
        ];
    }
}
