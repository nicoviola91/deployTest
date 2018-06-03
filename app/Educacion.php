<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Educacion extends Model
{
    protected $table="educaciones";
    protected $fillable =[
        'nivelAlcanzado',
        'institucion',
        'inicio',
        'fin',
        'comentarios',
        'orientacion',
        'tituloObtenido',
        'tipoEducacion_id',
        'ficha_educacion_id',
        'educacion_id',
    ];

    //representa la direccion de la institucion
    public function direccion(){
        return $this->hasOne('App\Direccion','educacion_id');
    }

    public function fichaEducacion(){
        return $this->belongsTo('App\FichaEducacion');
    }

    public function tipo(){
        return $this->belongsTo('App\TipoEducacion','tipoEducacion_id');
    } 


}
