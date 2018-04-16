<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $table='tratamientos';
    protected $fillable=[
        'tipo',
        'inicio',
        'fin',
        'estado',
        'causaDeFin',
        'comentarios'
    ];

    public function profesional(){
        return $this->belongsTo('App\Profesional');
    }

    public function medicaciones(){
        return $this->hasMany('App\Medicacion');
    }

    public function fichaAdiccion(){
        return $this->belongsTo('App\FichaAdiccion');
    }

    public function fichaSaludMental(){
        return $this->belongsTo('App\FichaSaludMental');
    }
}
