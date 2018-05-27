<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FichaAdiccion;

class Adiccion extends Model
{
    protected $table='adicciones';
    protected $fillable=[
        'sustanciaInicio',
        'sustanciaFin',
        'frecuencia',
        'modalidad',
        'edadInicio',
        'fichaAdiccion_id'
    ];

    public function fichaAdiccion(){
        return $this->belongsTo('App\FichaAdiccion','fichaAdiccion_id');
    }
}
