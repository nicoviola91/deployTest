<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="users";
    protected $fillable = [
        'name','apellido','email', 'password','dni',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function alertas(){
        return $this->hasMany('App\Alerta');
    }

    public function comunidad(){
        return $this->belongsTo('App\Comunidad');
    }
    
    public function consultas(){
        return $this->hasMany('App\Consulta');
    }
}
