<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaAsistenciaSocial extends Ficha
{
    protected $table="fichasAsistenciasSociales";
    protected $fillable = [
        'checkAsistenciaSocial',
        'asistido_id',
    ];

    public function serviciosSociales(){
        return $this->hasMany('App\ServicioSocial','fichaAsistenciaSocial_id');
    }

    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }
}
