<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EpisodioAgresivo extends Model
{
    protected $table='episodiosAgresivos';
    protected $fillable=[
        'tipo',
        'lugar',
        'fecha',
    ];

    public function fichaAdiccion(){
        return $this->belongsTo('App\FichaAdiccion');
    }

    public function fichaSaludMental(){
        return $this->belongsTo('App\FichaSaludMental');
    }
}
