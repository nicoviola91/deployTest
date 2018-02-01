<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaEmpleo extends Ficha
{
    //

    protected $fillable = [
        'empleo_id'
    ];

    public function empleos(){
        return $this->hasMany('App\FichaEducacion');
    }
}
