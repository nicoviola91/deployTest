<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table='instituciones';
    protected $fillable=[
        'nombre',
        'cuit',
        'responsable',
        'telefono',
        'mail',
        'fichaSaludMental_id',
        'tratamiento_id',
        'tipo',
        'direccion_id',
        'descripcion',
        'imagen',
        
    ];

    public function comunidades(){
        return $this->hasMany('App\Comunidad','institucion_id');
    }

    public function direccion(){
        return $this->belongsTo('App\Direccion', 'direccion_id');
    }

    public function serviciosSociales(){
        return $this->hasMany('App\ServicioSocial');
    }

    public function fichaSaludMental(){
        return $this->belongsTo('App\FichaSaludMental','fichaSaludMental_id');
    }

    public function consultasMedicas(){
        return $this->hasMany('App\ConsultaMedica','institucion_id');
    }

    public function intervenciones(){
        return $this->hasMany('App\Intervencion');
    }

    public function tratamiento(){
        return $this->belongsTo('App\Tratamiento');
    }

    public function users(){
        return $this->hasMany('App\User','institucion_id');
    }

}
