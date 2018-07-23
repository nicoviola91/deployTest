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
        'profesional_id',
        'fichaMedica_id',
        'sintoma_id',
        ''
    ];

    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }
    //Profesional=Medico de Cabecera
	public function profesional(){
		return $this->belongsTo('App\Profesional','profesional_id');
    }
    //enfermedades son tos, neumonia, etc. Van a estar categorizadas por la afeccion
	public function enfermedades(){
		return $this->belongsToMany('App\Enfermedad','fichasMedicas_enfermedades','fichaMedica_id','enfermedad_id');
	}
	public function medicaciones(){
		return $this->hasMany('App\Medicacion','fichaMedica_id');
	}    
    public function tratamientos(){
		return $this->hasMany('App\Tratamiento','fichaMedica_id');
	}
	public function sintomas(){
		return $this->belongsToMany('App\Sintoma','fichasMedicas_sintomas','fichaMedica_id','sintoma_id');		
    }
    
	public function consultasMedicas(){
		return $this->hasMany('App\ConsultaMedica','fichaMedica_id');
	}
	public function intervenciones(){
		return $this->hasMany('App\Intervencion','fichaMedica_id');	
	}
    public function evaluacionDiagnostica(){
		return $this->hasOne('App\EvaluacionDiagnostica','fichaMedica_id');
	}
}
