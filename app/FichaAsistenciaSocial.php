<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaAsistenciaSocial extends Ficha
{
    protected $table="fichasAsistenciasSociales";
    protected $fillable = [
        'checkAsistenciaSocial',
        'servicios',
       
    ];

    public function serviciosSociales(){
        return $this->hasMany('App\ServicioSocial');
    }

    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }
}
