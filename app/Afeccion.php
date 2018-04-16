<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Afeccion extends Model
{
    protected $table='afecciones';
    protected $fillable=[
        'tipo',
    ];

    public function patologia(){
        return $this->hasOne('App\Patologia');
    }

    public function fichaSaludMental(){
        return $this->belongsTo('App\FichaSaludMental');
    }

    
}
