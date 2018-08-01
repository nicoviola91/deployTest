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
        'comunidad_id'
    ];

   	public function user(){
   		return $this->belongsTo('App\User');
   	}

    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }

    public function comunidad(){
        return $this->belongsTo('App\Comunidad','comunidad_id');
    }
}
