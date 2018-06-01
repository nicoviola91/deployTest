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
        $fichaDatosPersonales=$this->findFichaDatosPersonalesByAsistidoId($id);
        if(isset($fichaDatosPersonales)){
            return view('altaFichas.fichaDatosPersonales')->with('asistido',$asistido)
                ->with('fichaDatosPersonales',$fichaDatosPersonales);
        }
      
        return view('altaFichas.fichaDatosPersonales')->with('asistido',$asistido);
    }

    public function store(Request $request, $asistido_id){

        $ficha= new FichaDatosPersonales($request->all());
        $asistido=Asistido::find($asistido_id);
        $asistido->checkFichaDatosPersonales=1;
        $ficha->asistidos_id=$asistido_id;
        $ficha->save();
        $asistido->save();
        return redirect()->route('asistido.show',['asistido_id'=>$asistido_id]);


    }

    public function findFichaDatosPersonalesByAsistidoId($asistido_id){
        $fichaDatosPersonales=FichaDatosPersonales::where('asistidos_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(empty($fichaDatosPersonales)){
            $fichaDatosPersonales=new FichaDatosPersonales();
            $asistido->ficha()->save($fichaDatosPersonales);
        }
        return $fichaDatosPersonales;
    }

}
