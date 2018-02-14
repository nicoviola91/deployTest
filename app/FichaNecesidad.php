<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaNecesidad extends Ficha
{
    protected $fillable =[
        'checklistNecesidades'
    ];

    //falta representar el tema de la coleccion:: update: con el hasMany es suficiente

    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }
    
    public function necesidades(){
        return $this->hasMany('App\Neccesidad');
    }
    
}
