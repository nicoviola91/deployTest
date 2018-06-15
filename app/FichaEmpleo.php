<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaEmpleo extends Ficha
{
    //
    protected $table="fichasEmpleos";
    protected $fillable = [
        'asistido_id'
    ];

    public function empleos(){
        return $this->hasMany('App\Empleo','fichaEmpleo_id');
    }

    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }
}
