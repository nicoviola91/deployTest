<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table='contactos';
    protected $fillable=[
        'tipo',
        'nombre',
        'apellido',
        'telefono',
        'mail',
        'fechaNacimiento',
        'fichaFamiliaAmigos_id'
    ];

    public function fichaFamiliaAmigos(){
        return $this->belongsTo('App\FichaFamiliaAmigos','fichaFamiliaAmigos_id');
    }
    
}
