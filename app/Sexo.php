<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    protected $table="sexos";
    protected $fillable = [
        'descripcion',
    ];

    public function fichasDatosPersonales(){
    	return $this->hasMany('App\FichaDatosPerseonales');
    }
    public function asistidos(){
    	return $this->hasMany('App\Asistido');
    }
}
