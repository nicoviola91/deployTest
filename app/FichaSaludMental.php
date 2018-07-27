<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaSaludMental extends Ficha
{
    protected $table='fichasSaludMental';
    protected $fillable=[
        'checkSintomasMentales',
        'estadoMental',
        'ansiedad',//add
        'depresivo',//add
        'trastornoCognitivo',//add
        'orientado',
        'intoxicado',
        'discurso',
        'checkMedicacion',
        'checkTratamiento',
        'checkAgresiones',
        'checkDerivacion',
        'checkInternacion',
        'asistido_id',
        'created_by',

    ];
    
    

    public function patologias(){
        return $this->hasMany('App\Patologia','fichaSaludMental_id');
    }

    public function medicaciones(){
        return $this->hasMany('App\Medicacion','fichaSaludMental_id');
    }

    public function tratamientos(){
        return $this->hasMany('App\Tratamiento','fichaSaludMental_id');
    }

    public function episodiosAgresivos(){
        return $this->hasMany('App\EpisodioAgresivo','fichaSaludMental_id');
    }

    public function institucion(){
        return $this->hasOne('App\Institucion','fichaSaludMental_id');
    }
    
    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }

}
