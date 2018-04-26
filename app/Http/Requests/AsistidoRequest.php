<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsistidoRequest extends FormRequest
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
            'nombre' => 'min:1|max:100|required',
            'apellido' => 'min:1|max:100|required',
            'dni' => 'min:7|max:100|required',
            'fechaNacimiento' => 'date',
            'observaciones' => 'max:255'
        ];
    }
}
