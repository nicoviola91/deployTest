<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    protected $table="estadosCiviles";
    protected $fillable = [
        'descripcion',
    ];

    public function fichasDatosPersonales(){
    	return $this->hasMany('App\FichaDatosPersonales');
    }
}
