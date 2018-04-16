<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaFamiliaAmigos extends Ficha
{
    protected $table='fichasFamiliaAmigos';


    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }

    public function contactos(){
        return $this->hasMany('App\Contactos');
    }
}
