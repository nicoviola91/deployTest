<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Necesidad extends Model
{
    protected $table="necesidades";
    protected $fillable =[
        'especificacion',
        'fechaInicio',
        'fechaFin',
        'fichaNecesidad_id',
        'tipoNecesidad_id',
    ];

    public function fichaNecesidad(){
        return $this->belongsTo('App\FichaNecesidad','fichaNecesidad_id');
    }
    public function tipo(){
        return $this->belongsTo('App\TipoNecesidad','tipoNecesidad_id');
    }
}
