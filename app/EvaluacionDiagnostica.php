<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionDiagnostica extends Model
{
    protected $table="fichasMedicas";
    protected $fillable = [
        'descripcion',
        'fichaMedica_id',
    ];

    public function tratamiento(){
    	return $this->belongsTo('App\Tratamiento');
    }
    public function profesional(){
    	return $this->belongsTo('App\Profesional');
    }
    public function fichaMedica(){
    	return $this->belongsTo('App\FichaMedica','fichaMedica_id');
    }
}
