<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table="consultas";
    protected $fillable = [
        'mensaje',
        'consultable_id',
        'consultable_type',
        'user_id'
    ];
    
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    //Vinculo hacia la ficha
    public function consultable(){
        return $this->morphTo();
    }


}
