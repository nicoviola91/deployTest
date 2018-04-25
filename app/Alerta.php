<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="alertas";
    protected $fillable = [
        'nombre','apellido','fechaNacimiento','dni', 'user_id','lat','lng','observaciones',
    ];

   	public function user(){
   		return $this->belongsTo('App\User');
   	}

}
