<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    protected $table="enfermedades";
    protected $fillable=[
        'descripcion',
        'comentarios',
        'enfermedad_id',
        'fichaMedica_id',
        'afeccion_id'];  


    public function fichasMedicas(){
        return $this->belongsToMany('App\FichaMedica','fichasMedicas_enfermedades','enfermedad_id','fichaMedica_id');
    }

    public function afeccion(){
        return $this->belongsTo('App\Afeccion','afeccion_id');
    }
}
