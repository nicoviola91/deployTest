<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaDatosPersonales extends Ficha
{
    protected $table="fichasDatosPersonales";
    protected $fillable = [
        'nombre',
        'apellido',
        'numeroDocumento',
        'fechaNacimiento',
        'edad',
        'tienePartida',
        'nacionalidad',
        'fechaIngresoPais',
        'celular',
        'telefono',
        'email',
        'nombreContacto',
        'telefonoContacto',
        'mailContacto',
    ];

    public function asistido(){
        return $this->belongsTo('App\Asistido','asistidos_id');
    }
    public function sexo(){
        return $this->belongsTo('App\Sexo');
    }
    public function estadoCivil(){
        return $this->belongsTo('App\EstadoCivil');    
    }
    public function estadoDocumento(){
        return $this->belongsTo('App\EstadoDocumento');
    }
    public function tipoDocumento(){
        return $this->belongsTo('App\TipoDocumento');
    }

}
