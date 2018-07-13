<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    protected $table="sintomas";
    protected $fillable = [
        'nombre',
        'fichaMedica_id',
        'sintoma_id',
        'fichasMedicas_id',
    ];

    public function fichasMedicas(){
    	return $this->belongsToMany('App\FichaMedica','fichasMedicas_sintomas','sintoma_id','fichasMedicas_id');
    }
    //agregar fk a la tabla sintomas

}
