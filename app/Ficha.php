<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Adiccion;

class Ficha extends Model
{
    
    public function asistido(){
    	return $this->belongsTo('App\Asistido');
    }

    //Vincula polimorficamente la ficha con sus comentarios
    public function consultas(){
        return $this->morphMany('App\Consulta','consultable');

    }
    public function usuariosCompartidos(){
    	return $this->hasMany('App\UsuarioCompartido');
    }

}

