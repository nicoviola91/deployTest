<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adiccion extends Model
{
    protected $table='adicciones';
    protected $fillable=[
        'frecuencia',
        'modalidad',
        'edadInicio',
    ];

    public function sustanciaInicio(){
        return $this->belongsTo('App\Sustancia');
    }

    public function sustanciaFin(){
        return $this->belongsTo('App\Sustancia');
    }

    public function fichaAdiccion(){
        return $this->belongsTo('App\FichaAdiccion');
    }
}
