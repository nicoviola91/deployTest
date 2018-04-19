<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    protected $table="sintomas";
    protected $fillable = [
        'nombre',
    ];

    public function fichasMedicas(){
    	return $this->belongsToMany('App\FichaMedica');
    }

}
