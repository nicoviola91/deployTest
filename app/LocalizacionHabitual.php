<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalizacionHabitual extends Model
{
    protected $table="localizacionesHabituales";

    protected $fillable=[
        'condicion',//domicilio o sitacion de calle
        'vivienda',
        'tipo',//propietario,inquilino, familiar
        'referenteNombre',
        'referenteTelefono',
        'referenteEmail',
        'fichaLocalizacion_id'
    ];

    public function fichaLocalizacion(){
        return $this->belongsTo('App\FichaLocalizacion','fichaLocalizacion_id');
    }

    public function direccion(){
        return $this->hasOne('App\Direccion','localizacionHabitual_id');
    }
}
