<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicioSocial extends Model
{
    protected $table="serviciosSociales";
    protected $fillable =[
        'fecha_inicio',
        'fecha_fin',
        
    ];

	public function institucion(){
        return $this->belongsTo('App\Institucion'); 
    }  

   public function fichaAsistenciaSocial(){
        return $this->belongsTo('App\fichaAsistenciaSocial');
    }
}
