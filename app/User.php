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
        'name','apellido','email', 'password','dni', 'tipoUsuario_id','chkFirmoAcuerdo','imagen'
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

    public function comunidades(){
        return $this->belongsToMany('App\Comunidad');
    }
    
    public function consultas(){
        return $this->hasMany('App\Consulta');
    }
    public function tipoUsuario(){
        return $this->belongsTo('App\TipoUsuario','tipoUsuario_id');
    }

    public function fichas(){
        return $this->hasMany('App\Ficha');
    }
    
}
