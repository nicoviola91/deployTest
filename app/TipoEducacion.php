<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEducacion extends Model
{
    protected $table="tiposEducaciones";
    protected $fillable=[
        'descripcion',
    ];
    
    public function educaciones(){
        return $this->hasMany('App\Educacion','tipoEducacion_id');
    }
}
