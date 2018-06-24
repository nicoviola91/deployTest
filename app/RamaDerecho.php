<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RamaDerecho extends Model
{
     protected $table="ramasDerecho";
    protected $fillable = [
        'descripcion',
    ];

    public function antecedentes(){
    	return $this->hasMany('App\Antecedente','ramaDerecho_id');
    }
}
