<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaLegal extends Model
{
    protected $table="fichasDatosLegales";
    protected $fillable = [
        'chk_antecedentesPenales',
    ];

    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }

    public function antecedentes(){
        return $this->hasMany('App\Asistido');
    }

}
