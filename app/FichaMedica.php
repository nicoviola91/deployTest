<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaMedica extends Model
{
    protected $table="fichasMedicas";
    protected $fillable = [
        'altura',
        'peso',
        'alergicoA', 
        'obraSocial',
        'antecedentes',
        'checkAlergico',
        'checkIntervencion',
        'checkMedicacion',
        'checkObraSocial',
        'checkTratamiento',
        'discapacidadVisual',
        'discapacidadAuditiva',
        'discapacidadMotriz',
        'observacionDiscapacidad',
    ];

    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }
    //Profesional=Medico de Cabecera
	public function profesional(){
		return $this->belongsTo('App\Profesional');
	}
	public function patologias(){
		return $this->belongsToMany('App\Patologia');
	}
	public function medicaciones(){
		return $this->hasMany('App\Medicacion');
	}    
    public function tratamientos(){
		return $this->hasMany('App\Tratamiento','fichaMedica_id');
	}
	public function sintomas(){
		return $this->belongsToMany('App\Sintoma');		
	}
	public function consultasMedicas(){
		return $this->hasMany('App\ConsultaMedica');
	}
	public function intervenciones(){
		return $this->hasMany('App\Intervencion');	
	}
    public function evaluacionDiagnostica(){
		return $this->hasOne('App\EvaluacionDiagnostica');
	}
}
