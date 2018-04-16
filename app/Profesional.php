<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    protected $table='profesionales';
    protected $fillable=[
        'nombre',
        'apellido',
        'especialidad', 
        'cargo',       
    ];

    public function medicacion(){
        return $this->hasOne('App\Medicacion');
    }

    public function tratamientos(){
        return $this->hasMany('App\Tratamiento');
    }


}
