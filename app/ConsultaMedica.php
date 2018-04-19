<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultaMedica extends Model
{
    protected $table="fichasMedicas";
    protected $fillable = [
        'fecha',
        'diagnostico',
    ];

    public function fichaMedica(){
        return $this->belongsTo('App\FichaMedica');
    }

    public function institucion(){
        return $this->belongsTo('App\Institucion');
    }

    public function profesional(){
        return $this->belongsTo('App\Profesional');
    }
}
