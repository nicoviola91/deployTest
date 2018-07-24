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
        'sexo_id',
        'estadoDocumento_id',
        'estadoCivil_id',
    ];

    public function asistido(){
        return $this->belongsTo('App\Asistido','asistidos_id');
    }
    public function sexo(){
        return $this->belongsTo('App\Sexo');
    }
    public function estadoCivil(){
        return $this->belongsTo('App\EstadoCivil','estadoCivil_id');    
    }
    public function estadoDocumento(){
        return $this->belongsTo('App\EstadoDocumento','estadoDocumento_id');
    }
    public function tipoDocumento(){
        return $this->belongsTo('App\TipoDocumento');
    }

}
