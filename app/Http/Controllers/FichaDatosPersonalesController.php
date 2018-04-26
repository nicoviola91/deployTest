<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FichaDatosPersonalesController extends Controller
{
    public function create(){
        return view('altaFichas.fichaDatosPersonales');
    }

    public function store(FichaDatosPersonalesRequest $request){

        $ficha= new FichaDatosPersonales($request->all());


    }

}
