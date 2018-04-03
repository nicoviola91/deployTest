
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiagnosticoIntegral extends Ficha
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="fichasDiagnosticosIntegrales";
    protected $fillable = [
        'diagnostico','trabajoInterdisciplinario',
    ];

   	public function cursosDeAccion(){
   		return $this->HasMany('App\CursoDeAccion');
   	}

   	public function asistido(){
        return $this->belongsTo('App\Asistido');
    }
}
