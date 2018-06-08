<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ZonaDePermanencia extends Model
{
    protected $table="zonasDePermanencia";
    

    protected $fillable=[
        'zona',
        'puntosDeReferencia',
        'dias',
        'de',//franja horaria inicio
        'hasta',//franja horaria final
        'fichaLocalizacion_id',
    ];

    public function direccion(){
        return $this->hasOne('App\Direccion');
    }
    
    public function fichaLocalizacion(){
        return $this->belongsTo('App\FichaLocalizacion','fichaLocalizacion_id');
    }
}
