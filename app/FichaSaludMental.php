<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaSaludMental extends Ficha
{
    protected $table='fichasSaludMental';
    protected $fillable=[
        'checkSintomasMentales',
        'signosObservables',
        'orientado',
        'intoxicado',
        'discurso',
        'checkMedicacion',
        'checkTratamiento',
        'checkAgresiones',
        'checkDerivacion',
        'checkInternacion',
    ];

    public function patologias(){
        return $this->hasMany('App\Patologia');
    }

    public function medicaciones(){
        return $this->hasMany('App\Medicacion');
    }

    public function tratamientos(){
        return $this->hasMany('App\Tratamiento');
    }

    public function episodiosAgesivos(){
        return $this->hasMany('App\EpisodioAgresivo');
    }

    public function institucion(){
        return $this->belongsTo('App\Institucion');
    }
    
    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }

}
