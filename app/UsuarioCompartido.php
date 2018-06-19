<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioCompartido extends Model
{
    protected $table="usuariosCompartidos";
    protected $fillable=[
    		'fichaDatosPersonales_id',
    		'fichaAdicciones_id',
    		'fichaAsistenciaSocial_id',
    		'fichaDiagnosticoIntegral_id',
    		'fichaEducacion_id',
    		'fichaEmpleo_id',
    		'fichaFamiliaAmigos_id',
    		'fichaLegal_id',
    		'fichaLocalizacion_id',
    		'fichaMedica_id',
    		'fichaNecesidad_id',
    		'fichaSaludMental_id',
    		'user_id',
    	];
    
    public function user(){
        return $this->belongsTo('App\Users');
    }
    public function ficha(){
    	return $this->belongsTo('App\Ficha');
    }
    /*public function asistido(){
    	return $this->belongsTo('App\Asistido');
	}*/
	
	public function fichaLegal(){
		return $this->belongsTo('App\FichaLegal','fichaLegal_id');
	}
}
