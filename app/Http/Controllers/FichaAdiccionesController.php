<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistido;
use App\Adiccion;
use App\FichaAdiccion;

class FichaAdiccionesController extends Controller
{
    public function create($asistido_id){
        $asistido=Asistido::find($asistido_id);
        return view('altaFichas.fichaAdicciones')->with('asistido',$asistido);
    }

    public function storeAdiccion(Request $request, $asistido_id){
        $adiccion=new Adiccion($request->all());
        $adiccion->save();

        $asistido=Asistido::find($id);
        $fichaAdiccion=FichaAdiccion::where('asistido_id',$asistido_id);
        if($fichaAdiccion==null){
            $fichaAdiccion=new FichaAdiccion();
            $fichaAdiccion->save();
        }
        //$fichaAdiccion->adicciones()->save($adiccion);
       
        var_dump($adiccion);
        var_dump($fichaAdiccion);
       
    }
    
}
