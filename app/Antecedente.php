<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    protected $table='antecedentes';
    protected $fillable=[
        'resumen',
        'radicacion',
        'profesional',
        'estadoTramite',
        'recomendacionPosadero',
    ];

    public function ramaDerecho(){
        return $this->belongsTo('App\RamaDerecho');
    }
    
    public function fichaLegal(){
        return $this->belongsTo('App\FichaLegal');
    }
}
