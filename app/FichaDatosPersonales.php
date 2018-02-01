<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaDatosPersonales extends Ficha
{
    protected $table="fichasDatosPersonales";
    protected $fillable = [
        'nombre',
        'apellido',
        'sexo',
        'tipoDocumento', 
        'numeroDocumento',
        'estadoDocumento',
        'fechaNacimiento',
        'edad',
        'tienePartida',
        'nacionalidad',
        'fechaIngresoPais',
        'estadoCivil',
        'celular',
        'telefono',
        'email',
        'nombreContacto',
        'telefonoContacto',
        'mailContacto',
    ];


}
