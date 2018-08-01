<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table="direcciones";
    protected $fillable = [
        'calle',
        'numero',
        'piso',
        'departamento',
        'entreCalles',
        'provincia',
        'codigoPostal',
        'pais',
        'localidad',
        //'institucion_id',
        'educacion_id',
        'localizacionHabitual_id',
        'zonaDePermanencia_id',
        'empleo_id',
        'lat',
        'long',

    ];

    /*public function asistido(){
        return $this->belongsTo('App\Asistido');
    }*/

    public function institucion(){
        return $this->hasOne('App\Institucion', 'institucion_id');
    }

    public function educacion(){
        return $this->belongsTo('App\Educacion','educacion_id');
    }

    public function localizacionHabitual(){
        return $this->belongsTo('App\LocalizacionHabitual','localizacionHabitual_id');
    }

    public function zonaDePermanencia(){
        return $this->belongsTo('App\ZonaDePermanencia','zonaDePermanencia_id');
    }

    public function empleo(){
        return $this->belongsTo('App\Empleo');
    }

}
