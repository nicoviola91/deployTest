<?php

namespace App\Http\Controllers;

use App\FichaDatosPersonales;
use App\Asistido;
use Illuminate\Http\Request;
use App\Http\Requests\FichaDatosPersonalesRequest;


class FichaDatosPersonalesController extends Controller
{
    public function create($id){
        $asistido=Asistido::find($id);
      
        return view('altaFichas.fichaDatosPersonales')->with('asistido',$asistido);
    }

    public function store(Request $request, $asistido_id){

        $ficha= new FichaDatosPersonales($request->all());
        $ficha->asistidos_id=$asistido_id;
        $ficha->save();


    }

}
