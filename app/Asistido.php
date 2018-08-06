<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistido extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="asistidos";
    protected $fillable = [
        'nombre','apellido','fechaNacimiento','dni','direccion','observaciones','foto', 'email','tipo','estado',
        'checkFichaEducacion',
        'checkFichaAdicciones',
        'checkFichaFamiliaAmigos',
        'checkFichaDatosPersonales',
        'checkFichaAsistenciaSocial',
        'checkFichaDiagnosticoIntegral',
        'checkFichaEmpleo',
        'checkFichaLegal',
        'checkFichaLocalizacion',
        'checkFichaMedica',
        'checkFichaNecesidad',
        'checkFichaSaludMental',
        'owner',
        'comunidad_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
        
        
    // ];

    //Un asistido deberia tener una ficha
    //Las fichas heredan el hasone
    //cada ficha concreta tendra la fk a asistido
    public function ficha(){
        return $this->hasOne('App\Ficha');
    }
    public function sexo(){
        return $this->belongsTo('App\Sexo');
    }
    public function alertas(){
        return $this->hasMany('App\Alerta');
    }

    public function getFullName()
    {
        return "{$this->nombre} {$this->apellido}";
    }

    /*public function usuariosCompartidos(){
        return $this->hasMany('App\UsuarioCompartido');
    }*/

    public function comunidades(){
        return $this->belongsToMany('App\Comunidad')->withTimestamps();;
    }

    public function comunidad(){
        return $this->belongsTo('App\Comunidad','comunidad_id');
    }
}
