<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaEducacion extends Ficha
{
    protected $table="fichasEducaciones";
    protected $fillable =[
        
    ];

    public function educaciones(){
        return $this->hasMany('App\Educacion','tipoEducacion_id');
    }

}
