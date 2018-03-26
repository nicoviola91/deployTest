<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Educacion extends Model
{
    protected $table="educaciones";
    protected $fillable =[
        'tipo',//enum 
        'nivelAlcanzado',
        'institucion',
        'direccion_id',
        'inicio',
        'fin',
        'comentarios',
        'orientacion',
        'tituloObtenido',
    ];

    //representa la direccion de la institucion
    public function direccion(){
        return $this->hasOne('App\Direccion');
    }

    public function fichaEducacion(){
        return $this->belongsTo('App\FichaEducacion');
    }


}
