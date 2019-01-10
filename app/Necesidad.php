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
        'created_by',
    ];

    public function fichaNecesidad(){
        return $this->belongsTo('App\FichaNecesidad','fichaNecesidad_id');
    }
    public function tipo(){
        return $this->belongsTo('App\TipoNecesidad','tipoNecesidad_id');
    }
    public function donacion(){
        return $this->hasOne('App\Donacion');
    }
    public function owner(){
        return $this->belongsTo('App\Users', 'created_by');
    }
}
