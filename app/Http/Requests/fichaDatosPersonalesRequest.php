<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class fichaDatosPersonalesRequest extends FormRequest
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
            'nombre'=> 'min:1|max:50|string|required',
            'apellido' => 'min:1|max:50|string',
            'numeroDocumento' => 'numeric',
            'fechaNacimiento' => 'date',
            'tienePartida' => 'boolean',
            'nacionalidad'=> 'min:1|max:50|string',
            'fechaIngreso' => 'date',
            'celular'=> 'numeric',
            'telefono' => 'numeric',
            'email' => 'email',
            'nombreContacto' =>'string',
            'telefonoContacto' => 'numeric',
            'emailContacto' => 'email',
        ];
    }
}
