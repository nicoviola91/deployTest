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
        'checkDiscapacitado',
        'checkTratamiento',
    ];

    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }
	public function medicoCabecera(){
		return $this->hasOne('App\Profesional');
	}
	public function patologias(){
		return $this->hasMany('App\Patologia');
	}
	public function medicaciones(){
		return $this->hasMany('App\Medicacion');
	}    
    public function tratamientos(){
		return $this->hasMany('App\Tratamiento');
	}

    /*    FALTAN AGREGAR LAS RELACIONES
		public function sintomas(){
			return $this->hasMany('App\Sintoma');		
		}
		public function consultas_medicas(){
			return $this->hasMany('App\Consulta');
		}
		public function intervenciones(){
			return $this->hasMany('App\Intervencion');	
		}
		public function eval_diagnostica(){
			return $this->hasOne('App\EvaluacionDiagnostica');
		}

		Esta estoy en duda
		public function discapacidades(){
			return $this->hasMany('App\Discapacidad');
		}
    */
}
