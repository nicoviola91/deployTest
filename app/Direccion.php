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

    public function toString() {

        $s = "";

        if (isset($this->calle))
            $s.= ($this->calle . " ");

        if (isset($this->numero))
            $s.= ($this->numero . " ");

        if (isset($this->piso))
            $s.= (" piso " . $this->piso . " ");

        if (isset($this->provincia))
            $s.= (", " . $this->provincia . " ");

        if (isset($this->codigoPostal))
            $s.= (" (CP " . $this->codigoPostal . ") ");


        return $s;
    }

}
