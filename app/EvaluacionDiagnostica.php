<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionDiagnostica extends Model
{
    protected $table="fichasMedicas";
    protected $fillable = [
        'descripcion',
    ];

    public function tratamiento(){
    	return $this->belongsTo('App\Tratamiento');
    }
    public function profesional(){
    	return $this->belongsTo('App\Profesional');
    }
    public function fichaMedica(){
    	return $this->belongsTo('App\FichaMedica');
    }
}
