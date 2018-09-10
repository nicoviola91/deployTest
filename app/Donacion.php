<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{
    protected $table="donaciones";
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
