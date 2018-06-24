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
        'fichaLegal_id',
        'ramaDerecho_id'
    ];

    public function ramaDerecho(){
        return $this->belongsTo('App\RamaDerecho','ramaDerecho_id');
    }
    
    public function fichaLegal(){
        return $this->belongsTo('App\FichaLegal','fichaLegal_id');
    }
}
