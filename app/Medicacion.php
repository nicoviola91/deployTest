<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicacion extends Model
{
    protected $table='medicaciones';
    protected $fillable=[
        'droga',
        'dosis',
        'posologia',
        'inicio',
        'fin',
        'recetada',
    ];

    public function profesionalQueReceta(){
        return $this->belongsTo('App\Profesional');
    }

    public function tratamiento(){
        return $this->belongsTo('App\Tratamiento');
    }

    public function fichaSaludMental(){
        return $this->belongsTo('App\FichaSaludMental');
    }
}
