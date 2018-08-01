<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
	protected $table="comunidades";
    protected $fillable = [
        'nombre', 
        'tipo',
        //'parroquia_id',
        'observaciones',
        'institucion_id'
    ];

    public function users(){
    	return $this->hasMany('App\User','comunidad_id');
    }

    public function asistidos(){
    	return $this->hasMany('App\Asistido','comunidad_id');
    }

    public function institucion(){
        return $this->belongsTo('App\Institucion','institucion_id');
    }

    public function alertas(){
        return $this->hasMany('App\Alerta','comunidad_id');
    }


}