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
    ];

    public function adicciones(){
        return $this->hasMany('App\Adiccion','fichaAdiccion_id');
    }


    public function tratamientos(){
        return $this->hasMany('App\Tratamiento');
    }

    public function episodiosAgresivos(){
        return $this->hasMany('App\EpisodioAgresivo');
    }



}
