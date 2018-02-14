<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaEducacion extends Ficha
{
    protected $table='fichasEducaciones';
    protected $fillable =[
        'eduacion_id',
    ];

    public function educaciones(){
        return $this->hasMany('App\Educacion');
    }

    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }
    
}
