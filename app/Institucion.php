<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table='instituciones';
    protected $fillable=[
        'nombre',
        'cuit',
        'responsable'
    ];

    public function comunidades(){
        return $this->hasMany('App\Comunidad');
    }

    public function direccion(){
        return $this->hasOne('App\Direccion');
    }

    public function servicioSocial(){
        return $this->belongsTo('App\ServicioSocial');
    }
}
