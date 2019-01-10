<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MensajeComunidad extends Model
{
    protected $table="consultas";
    protected $fillable = [
        'mensaje',
        'created_by',
        'comunidad_id',
        'adjunto'
    ];
    
    public function author(){
        return $this->belongsTo('App\User','created_by');
    }

    public function comunidad(){
        return $this->belongsTo('App\Comunidad','comunidad_id');
    }



}
