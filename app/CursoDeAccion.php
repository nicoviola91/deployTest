<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoDeAccion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="cursosDeAcciones";
    protected $fillable = [
        'meta','fechaDesde','fechaHasta','accion','fichaDiagnosticoIntegral_id'
    ];

   	public function fichaDiagnosticoIntegral(){
   		return $this->belongsTo('App\FichaDiagnosticoIntegral','fichaDiagnosticoIntegral_id');
   	}
}
