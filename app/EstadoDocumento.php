<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoDocumento extends Model
{
    protected $table="estadosDocumentos";
    protected $fillable = [
        'descripcion',
    ];

    public function fichasDatosPersonales(){
    	return $this->hasMany('App\FichaDatosPersonales');
    }
}
