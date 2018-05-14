<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FichaDatosPersonalesRequest extends FormRequest
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
            'nombre'=> 'min:1|max:50|required',
            'apellido' => 'min:1|max:50|string',
            'numeroDocumento' => 'numeric',
            'fechaNacimiento' => 'date',
            'tienePartida' => 'boolean',
            'nacionalidad'=> 'min:1|max:50',
            'fechaIngreso' => 'date',
            'celular'=> 'numeric',
            'telefono' => 'numeric',
            'email' => 'email',
            'telefonoContacto' => 'numeric',
            'emailContacto' => 'email',
        ];
    }
}
