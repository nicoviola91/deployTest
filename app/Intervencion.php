<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intervencion extends Model
{
    protected $table="intervenciones";
    protected $fillable = [
        'diagnostico',
        'tipoOperacion',
        'fecha', 
        'tratamientoIndicado',
        'medicacion',
    ];

    public function institucion(){
    	return $this->belongsTo('App\Institucion');
    }

    public function profesional(){
    	return $this->belongsTo('App\Profesional');
    }
    
    public function fichaMedica(){
    	return $this->belongsTo('App\FichaMedica');
    }
}
