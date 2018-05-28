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
        'comentarios',
        'fichaAdiccion_id'
    ];

    public function profesional(){
        return $this->belongsTo('App\Profesional');
    }

    public function medicaciones(){
        return $this->hasMany('App\Medicacion');
    }

    public function fichaAdiccion(){
        return $this->belongsTo('App\FichaAdiccion','fichaAdiccion_id');
    }

    public function fichaSaludMental(){
        return $this->belongsTo('App\FichaSaludMental');
    }

    public function fichaMedica(){
        return $this->belongsTo('App\FichaMedica');
    }
}
