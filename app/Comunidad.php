<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
	protected $table="comunidades";
    protected $fillable = [
        'nombre', 'tipo','parroquia_id','observaciones'
    ];

    public function users(){
    	return $this->hasMany('App\User');
    }

    public function asistidos(){
    	return $this->hasMany('App\Asistido');
    }

    public function institucion(){
        return $this->belongsTo('App\Institucion');
    }

}
