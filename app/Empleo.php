<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleo extends Model
{
    protected $fillable =[
        'puesto',
        'empleador',
        'direccion_id', //direccion empleo
        'descripcion',
        'inicio',
        'fin',
        'nombreReferente',
        'telefonoReferente',
        'puestoReferente',
        'mailReferente',
    ];

    public function fichaEmpleo(){
        return $this->belongsTo('App\FichaEmpleo');
    }
}
