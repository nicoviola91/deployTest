<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
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

    public function parroquia(){
        return $this->belongsTo('App\Parroquia');
    }

    public function fichaLocalizacion(){
        return $this->belongsTo('App\FichaLocalizacion');
    }

    public function educacion(){
        return $this->belongsTo('App\Educacion');
    }

}
