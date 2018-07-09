<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    protected $table="sintomas";
    protected $fillable = [
        'nombre',
        'fichaMedica_id'
    ];

    public function fichasMedicas(){
    	return $this->belongsTo('App\FichaMedica','fichaMedica_id');
    }
    //agregar fk a la tabla sintomas

}
