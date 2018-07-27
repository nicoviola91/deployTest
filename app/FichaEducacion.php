<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaEducacion extends Ficha
{
    protected $table="fichasEducaciones";
    protected $fillable =['created_by'];

    public function educaciones(){
        return $this->hasMany('App\Educacion');
    }

}
