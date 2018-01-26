<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class Ficha extends Model
{
    
    public function asistido(){
    	return $this->hasOne('App\Asistido');
    }

    public function consultas(){
    	return $this->hasMany('App\Consulta');
    }
}
