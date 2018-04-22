<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoNecesidad extends Model
{
    protected $table="tiposNecesidades";
    protected $fillable=[
        'descripcion',
    ];
    
    public function necesidades(){
        return $this->hasMany('App\Necesidad');
    }
}
