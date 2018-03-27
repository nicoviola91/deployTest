<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Necesidad extends Model
{
    protected $table="necesidades";
    protected $fillable =[
        'tipo',
        'especificacion',
        'fechaInicio',
        'fechaFin'
    ];

    public function fichaNecesidad(){
        return $this->belongsTo('App\FichaNecesidad');
    }
}
