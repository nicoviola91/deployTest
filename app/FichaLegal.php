<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaLegal extends Model
{
    protected $table="fichasLegales";
    protected $fillable = [
        'chk_antecedentesPenales',
        'asistido_id',
        'created_by',
    ];

    public function asistido(){
        return $this->belongsTo('App\Asistido');
    }

    public function antecedentes(){
        return $this->hasMany('App\Antecedente','fichaLegal_id');
    }

    public function usuariosCompartidos(){
        return $this->hasMany('App\UsuarioCompartido','fichaLegal_id');
    }

}
