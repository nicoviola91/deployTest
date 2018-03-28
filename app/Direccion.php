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
        'pais'
    ];

    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }

    public function institucion(){
        return $this->belongsTo('App\Institucion');
    }

    public function fichaLocalizacion(){
        return $this->belongsTo('App\FichaLocalizacion');
    }

    public function educacion(){
        return $this->belongsTo('App\Educacion');
    }

}
