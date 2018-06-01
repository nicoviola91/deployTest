<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patologia extends Model
{
    protected $table='patologias';
    protected $fillable=[
        'descripcion',
        'comentarios',
    ];

    public function afeccion(){
        return $this->belongsTo('App\Afeccion');
    }
    public function fichasMedicas(){
    	return $this->belongsToMany('App\FichaMedica');
    }
    public function fichasSaludMental(){
        return $this->belongsToMany('App\FichaSaludMental');
    }
}
