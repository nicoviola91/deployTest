<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FichaAdiccionesController extends Controller
{
    public function create(){
        return view('altaFichas.fichaAdicciones');
    }
    
}
