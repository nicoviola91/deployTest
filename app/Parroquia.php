<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    

        
    protected $table="parroquias";
    protected $fillable = [
        'nombre','direccion_id','telefono' 
    ];

   	public function comunidades(){
   		return $this->hasMany('App\Comunidad');
   	}

    public function direccion(){
        return $this->hasOne('App\Direccion');
    }
}
