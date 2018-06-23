<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicioSocial extends Model
{
    protected $table="serviciosSociales";
    protected $fillable =[
        'fecha_inicio',
        'fecha_fin',
        'tipo',
        'prestador',
        'direccion',
        'telefono',
        'referente',
        'fichaAsistenciaSocial_id'
        
    ];

   public function fichaAsistenciaSocial(){
        return $this->belongsTo('App\fichaAsistenciaSocial','fichaAsistenciaSocial_id');
    }
}
