<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaLocalizacion extends Ficha
{
    protected $table="fichasLocalizacion";
    protected $fillable = [
      
        'situacionCalle',
        'zonaPermanencia',
        'asistido_id',
        'created_by',
        //'direccion_id'
    ];


    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }

    public function zonasDePermanencia(){
        return $this->hasMany('App\ZonaDePermanencia','fichaLocalizacion_id');
    }

    public function localizacionesHabituales(){
        return $this->hasMany('App\LocalizacionHabitual','fichaLocalizacion_id');
    }
}
