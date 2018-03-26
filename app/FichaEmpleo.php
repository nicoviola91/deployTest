<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaEmpleo extends Ficha
{
    //
    protected $table="fichasEmpleos";
    protected $fillable = [
        'empleo_id'
    ];

    public function empleos(){
        return $this->hasMany('App\Empleo');
    }
}
