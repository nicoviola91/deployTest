<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
	protected $table="comunidades";
    protected $fillable = [
        'nombre', 
        'tipo',
        'observaciones',
        'institucion_id',
        'coordinador_id'
    ];

    public function users(){
    	//return $this->hasMany('App\User','comunidad_id');
        return $this->belongsToMany('App\User')->withTimestamps();;
    }

    public function asistidos(){
    	//return $this->hasMany('App\Asistido','comunidad_id');
        return $this->belongsToMany('App\Asistido')->withTimestamps();;
    }

    public function institucion(){
        return $this->belongsTo('App\Institucion','institucion_id');
    }

    public function alertas(){
        return $this->hasMany('App\Alerta','comunidad_id');
    }
    public function solicitudes(){
        return $this->hasMany('App\Solicitud');
    }
    public function coordinador(){
        return $this->belongsTo('App\User','coordinador_id');
    }
    public function coordinadores() {
        return $this->hasMany('App\User', 'comunidad_id');
    }

     public function mensajes() {
        return $this->hasMany('App\MensajeComunidad');
    }

}