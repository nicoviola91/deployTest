<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{
    protected $table="direcciones";
    protected $fillable = [
        'nombre',
        'apellido',
        'tel_contacto',
        'mail_contacto',
        'mensaje',
    ];

    public function necesidad(){
    	return $this->hasOne('App\Necesidad');
    }
}
