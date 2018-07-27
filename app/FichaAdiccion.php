<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Adiccion;
use App\Ficha;

class FichaAdiccion extends Ficha
{
    protected $table="fichasAdicciones";
    protected $fillable =[
        'checklistAdicciones',
        'checklistTratamiento',
        'checklistEpisodiosAgresivos',
        'checklistRequiereDerivacion',
        'checklistRequiereInternacion',
        'checklistEmbarazo',
        'observaciones',
        'created_by',
    ];

    public function adicciones(){
        return $this->hasMany('App\Adiccion','fichaAdiccion_id');
    }


    public function tratamientos(){
        return $this->hasMany('App\Tratamiento','fichaAdiccion_id');
    }

    public function episodiosAgresivos(){
        return $this->hasMany('App\EpisodioAgresivo','fichaAdiccion_id');
    }



}
