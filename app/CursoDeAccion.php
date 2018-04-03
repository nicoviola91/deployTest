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
    protected $table="cursosDeAccion";
    protected $fillable = [
        'meta','fechaDesde','fechaHasta','accion',
    ];

   	public function fichaDiagnosticoIntegral(){
   		return $this->belongsTo('App\FichaDiagnosticoIntegral');
   	}
}
