<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="solicitudes";
    protected $fillable = [ 
        'user_id',
        'observaciones',
        'comunidad_id',
        'tipoSolicitud_id',
        'estado',
    ];

   	public function user(){
   		return $this->belongsTo('App\User');
   	}
   	/*Por ahora la solicitud es para agregarse a una comunidad. Es nullable por si a futuro se quiere hacer otra cosa*/
   	public function comunidad(){
   		return $this->belongsTo('App\Comunidad');
   	}

}
