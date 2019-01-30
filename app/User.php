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
        'name','apellido','email', 'password','dni', 'tipoUsuario_id','chkFirmoAcuerdo','imagen',
        'institucion_id','comunidad_id','descripcion','readNotif'

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
    
    public function consultas(){
        return $this->hasMany('App\Consulta');
    }
    public function tipoUsuario(){
        return $this->belongsTo('App\TipoUsuario','tipoUsuario_id');
    }

    public function fichas(){
        return $this->hasMany('App\Ficha');
    }

    public function institucion(){
        return $this->belongsTo('App\Institucion','institucion_id');
    }

    public function comunidad(){
        return $this->belongsTo('App\Comunidad','comunidad_id');
    }

    public function comunidades(){
        return $this->belongsToMany('App\Comunidad')->withTimestamps();;
    }

    public function owners(){
        return $this->hasMany('App\Asistido', 'owner');
    }

    public function asistidos(){
        return $this->hasMany('App\Asistido');
    }

    public function favoritos() {
        return $this->belongsToMany('App\Asistido', 'favoritos')->withTimestamps();
    }

    // public function creators(){
    //     return $this->hasMany('App\Asistido', 'createdBy');
    // }
    
}
