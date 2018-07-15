<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultaMedica extends Model
{
    protected $table="consultasMedicas";
    protected $fillable = [
        'fecha',
        'diagnostico',
        'fichaMedica_id',
        'institucion_id',
        'profesional_id',
    ];

    public function fichaMedica(){
        return $this->belongsTo('App\FichaMedica','fichaMedica_id');
    }

    public function institucion(){
        return $this->belongsTo('App\Institucion','institucion_id');
    }

    public function profesional(){
        return $this->belongsTo('App\Profesional','profesional_id');
    }
}
