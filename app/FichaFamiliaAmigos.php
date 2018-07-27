<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaFamiliaAmigos extends Ficha
{
    protected $table='fichasFamiliaAmigos';
    protected $fillable = [
        'asistido_id','created_by',
    ];

    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }

    public function contactos(){
        return $this->hasMany('App\Contacto','fichaFamiliaAmigos_id');
    }
}
