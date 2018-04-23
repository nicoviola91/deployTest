<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table='instituciones';
    protected $fillable=[
        'nombre',
        'cuit',
        'responsable'
    ];

    public function comunidades(){
        return $this->hasMany('App\Comunidad');
    }

    public function direccion(){
        return $this->hasOne('App\Direccion');
    }

    public function serviciosSociales(){
        return $this->hasMany('App\ServicioSocial');
    }

    public function fichaSaludMental(){
        return $this->hasMany('App\FichaSaludMental');
    }

    public function consultasMedicas(){
        return $this->hasMany('App\ConsultaMedica');
    }

    public function intervenciones(){
        return $this->hasMany('App\Intervencion');
    }

}