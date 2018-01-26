<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table="consultas";
    protected $fillable = [
        'mensaje'
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function ficha(){
    	return $this->belongsTo('App\Ficha');
    }
}
