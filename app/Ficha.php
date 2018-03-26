<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class Ficha extends Model
{
    
    public function asistido(){
    	return $this->hasOne('App\Asistido');
    }

    //Vincula polimorficamente la ficha con sus comentarios
    public function comments(){
        return $this->morphToMany('App\Consulta','commentable');

    }
}

