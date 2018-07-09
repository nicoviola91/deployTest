<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patologia extends Model
{
    protected $table='patologias';
    protected $fillable=[
        'descripcion',
        'comentarios',
        'fichaSaludMental_id',
        'fichaMedica_id',
        'tipo'
    ];

    
    public function fichaSaludMental(){
        return $this->belongsTo('App\FichaSaludMental','fichaSaludMental_id');
    }

    public function fichaMedica(){
        return $this->belongsTo('App\FichaMedica','fichaMedica_id');
    }
}
