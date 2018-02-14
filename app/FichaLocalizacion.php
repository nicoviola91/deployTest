<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaLocalizacion extends Ficha
{
    protected $fillable = [
      
        'situacionCalle',
        'zonaPermanencia',
        'direccion_id'
    ];

    public function direccion(){
        return $this->hasOne('App\Direccion');
    }

    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }
}
