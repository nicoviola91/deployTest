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
        'fichaSaludMental_id',
        'fichaAdiccion_id'
    ];

    public function fichaAdiccion(){
        return $this->belongsTo('App\FichaAdiccion','fichaAdiccion_id');
    }

    public function fichaSaludMental(){
        return $this->belongsTo('App\FichaSaludMental','fichaSaludMental_id');
    }
}
