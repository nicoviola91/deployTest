<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sustancia extends Model
{
    protected $table="sustancias";
    protected $fillable=[
        'sustancia',
    ];

    public function adiccion(){
        return $this->hasOne('App\Adiccion');
    }
}
