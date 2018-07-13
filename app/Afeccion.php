<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Afeccion extends Model
{
    protected $table="afecciones";
    protected $fillable = [
        'tipo',
    ];

    public function enfermedades(){
        $return->hasMany('App\Enfermedad','afeccion_id');
    }

}
