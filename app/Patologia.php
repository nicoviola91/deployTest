<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patologia extends Model
{
    protected $table='patologias';
    protected $fillable=[
        'descripcion',
        'comentarios',
    ];

    public function afeccion(){
        return $this->belongsTo('App\Afeccion');
    }
}
