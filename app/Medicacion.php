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
        'fichaSaludMental_id',
        'profesional_id',
        'fichaSaludMental_id',
        'fichaMedica_id'
    ];

    public function profesional(){
        return $this->belongsTo('App\Profesional','profesional_id');
    }

    public function tratamiento(){
        return $this->belongsTo('App\Tratamiento');
    }

    public function fichaSaludMental(){
        return $this->belongsTo('App\FichaSaludMental','fichaSaludMental_id');
    }

    public function fichaMedica(){
        return $this->belongsTo('App\FichaMedica','fichaMedica_id');//ver que del lado de ficha medica este fichaMedica_id
    }

}
