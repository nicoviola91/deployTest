<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicacion extends Model
{
    protected $table='medicaciones';
    protected $fillable=[
        'droga',
        'dosis',
        'frecuencia',//cambiar en tabla, se llama posologia
        'inicio',
        'fin',
        'recetada',//Dentro de recetada va indicada bajo receta o automedicacion 
        'fichaSaludMental_id'
    ];

    public function profesional(){
        return $this->hasOne('App\Profesional');
    }

    public function tratamiento(){
        return $this->belongsTo('App\Tratamiento');
    }

    public function fichaSaludMental(){
        return $this->belongsTo('App\FichaSaludMental','fichaSaludMental_id');
    }

    public function fichaMedica(){
        return $this->belongsTo('App\FichaMedica');
    }

}
