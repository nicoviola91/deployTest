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
        'necesidad_id'
    ];

    public function necesidad(){
    	return $this->belongsTo('App\Necesidad');
    }
}
