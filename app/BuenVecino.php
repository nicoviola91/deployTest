<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuenVecino extends Model
{
    protected $table="buenosVecinos";
    protected $fillable = [
        'nombre','direccion','telefono' 
    ];

   	public function comunidades(){
   		return $this->hasMany('App\Comunidad');
   	}

}
