<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table="direcciones";
    protected $fillable = [
        'calle',
        'numero',
        'piso',
        'departamento',
        'entreCalles',
        'provincia',
        'codigoPostal',
        'pais',
        'localidad',
        'institucion_id',
        'educacion_id',
        'fichaLocalizacion_id',

    ];

    /*public function asistido(){
        return $this->belongsTo('App\Asistido');
    }*/

    public function institucion(){
        return $this->belongsTo('App\Institucion');
    }

    public function fichaLocalizacion(){
        return $this->belongsTo('App\FichaLocalizacion','fichaLocalizacion_id');
    }

    public function educacion(){
        return $this->belongsTo('App\Educacion','educacion_id');
    }

}
