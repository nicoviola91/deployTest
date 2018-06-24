<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaDiagnosticoIntegral extends Ficha
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="fichasDiagnosticosIntegrales";
    protected $fillable = [
        'diagnostico','trabajoInterdisciplinario','asistido_id'
    ];

   	public function cursosDeAccion(){
   		return $this->HasMany('App\CursoDeAccion','fichaDiagnosticoIntegral_id');
   	}

   	public function asistido(){
        return $this->belongsTo('App\Asistido');
    }
}
