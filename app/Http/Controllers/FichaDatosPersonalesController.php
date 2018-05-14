<?php

namespace App\Http\Controllers;

use App\FichaDatosPersonales;
use Illuminate\Http\Request;
use App\Http\Requests\FichaDatosPersonalesRequest;


class FichaDatosPersonalesController extends Controller
{
    public function create(){
        return view('altaFichas.fichaDatosPersonales');
    }

    public function store(FichaDatosPersonalesRequest $request){

        $ficha= new FichaDatosPersonales($request->all());

        var_dump($ficha);

        $ficha->save();


    }

}
