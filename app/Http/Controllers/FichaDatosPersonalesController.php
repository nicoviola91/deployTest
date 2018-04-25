<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FichaDatosPersonalesController extends Controller
{
    public function create(){
        return view('altaFichas.fichaDatosPersonales');
    }

}
