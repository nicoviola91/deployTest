<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistido;
use App\Adiccion;
use App\FichaAdiccion;
use App\Ficha;
use App\Sustancia;

class FichaAdiccionesController extends Controller
{
    public function create($asistido_id){
        $asistido=Asistido::find($asistido_id);
        //para poder mostrar las sutancias cuando se agrega una adiccion
        $sustancias=Sustancia::all(['id','sustancia']);

        $fichaAdiccion=FichaAdiccion::where('asistido_id',$asistido_id)->first();
        if(!empty($fichaAdiccion)){
            $adicciones=Adiccion::where('fichaAdiccion_id',$fichaAdiccion->id)->get();
            return view('altaFichas.fichaAdicciones')->with('asistido',$asistido)->with('sustancias',$sustancias)->with('adicciones',$adicciones)->with('fichaAdiccion',$fichaAdiccion);
        }
        return view('altaFichas.fichaAdicciones')->with('asistido',$asistido)->with('sustancias',$sustancias);
    }

    public function storeAdiccion(Request $request, $asistido_id){
        //falta obtener lo que esta dentro del dropdown , no lo esta agarrando
        $asistido=Asistido::find($asistido_id);
        $sustancias=Sustancia::all(['id','sustancia']);
        $fichaAdiccion=FichaAdiccion::where('asistido_id',$asistido_id)->first();
        if(empty($fichaAdiccion)){
            $fichaAdiccion=new FichaAdiccion();
            $fichaAdiccion->checklistAdicciones=1;
            $asistido->ficha()->save($fichaAdiccion);
        }

        $adiccion=new Adiccion($request->all());
        //fichaAdiccion_id en la clase adiccion tiene que ser fillable para que funcione con Eloquent
        $fichaAdiccion->adicciones()->save($adiccion);
        //$adiccion->fichaAdiccion()->save($fichaAdiccion);
        $adiccion->save();
        $adicciones=Adiccion::where('fichaAdiccion_id',$fichaAdiccion->id)->get();

        return redirect()->route('fichaAdicciones.create',['asistido_id'=>$asistido_id]);       
    }

    public function destroyAdiccion($adiccion_id,$asistido_id){

        $adiccion=Adiccion::find($adiccion_id);
        $adiccion->delete();
        return redirect()->route('fichaAdicciones.create',['asistido_id'=>$asistido_id]);

    }


    public function showAdicciones(){
        $adicciones=Adiccion::all();

    }

    
}
