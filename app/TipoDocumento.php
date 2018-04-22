<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table="tiposDocumentos";
    protected $fillable = [
        'descripcion',
    ];

    public function fichasDatosPersonales(){
    	return $this->hasMany('App\FichaDatosPersonales');
    }
}
