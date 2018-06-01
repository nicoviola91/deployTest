<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistido;
use App\Adiccion;
use App\FichaAdiccion;
use App\Ficha;
use App\Sustancia;
use App\EpisodioAgresivo;
use App\Tratamiento;

class FichaAdiccionesController extends Controller
{
    public function create($asistido_id){
        $asistido=Asistido::find($asistido_id);
        //para poder mostrar las sutancias cuando se agrega una adiccion
        $sustancias=Sustancia::all(['id','sustancia']);

        $fichaAdiccion=FichaAdiccion::where('asistido_id',$asistido_id)->first();
        //en este metodo, traer las colecciones de tratamientos, episodios y adicciones, si existe la ficha
        if(!empty($fichaAdiccion)){
            $adicciones=Adiccion::where('fichaAdiccion_id',$fichaAdiccion->id)->get();
            $episodiosAgresivos=EpisodioAgresivo::where('fichaAdiccion_id',$fichaAdiccion->id)->get();
            $tratamientos=Tratamiento::where('fichaAdiccion_id',$fichaAdiccion->id)->get();
            return view('altaFichas.fichaAdicciones')
                ->with('asistido',$asistido)
                ->with('sustancias',$sustancias)
                ->with('adicciones',$adicciones)
                ->with('fichaAdiccion',$fichaAdiccion)
                ->with('episodiosAgresivos',$episodiosAgresivos)
                ->with('tratamientos',$tratamientos);
        }
        return view('altaFichas.fichaAdicciones')->with('asistido',$asistido)->with('sustancias',$sustancias);
    }

    public function storeAdiccion(Request $request, $asistido_id){
        //falta obtener lo que esta dentro del dropdown , no lo esta agarrando
        $asistido=Asistido::find($asistido_id);
        $asistido->checkFichaAdicciones=1;
        $sustancias=Sustancia::all(['id','sustancia']);
        $fichaAdiccion=$this->findFichaAdiccionByAsistidoId($asistido_id);
        $fichaAdiccion->checklistAdicciones=1;
        $adiccion=new Adiccion($request->all());
        //fichaAdiccion_id en la clase adiccion tiene que ser fillable para que funcione con Eloquent
        $fichaAdiccion->adicciones()->save($adiccion);
        //$adiccion->fichaAdiccion()->save($fichaAdiccion);
        $adiccion->save();

        return redirect()->route('fichaAdicciones.create',['asistido_id'=>$asistido_id]);       
    }

    public function destroyAdiccion($adiccion_id,$asistido_id){

        $adiccion=Adiccion::find($adiccion_id);
        $adiccion->delete();
        return redirect()->route('fichaAdicciones.create',['asistido_id'=>$asistido_id]);

}

    public function storeEpisodioAgresivo(Request $request, $asistido_id){
        $episodioAgresivo=new EpisodioAgresivo($request->all());
        $asistido=Asistido::find($asistido_id);
        $asistido->checkFichaAdicciones=1;
        $fichaAdiccion=$this->findFichaAdiccionByAsistidoId($asistido_id);
        $fichaAdiccion->checklistEpisodiosAgresivos=1;
        $fichaAdiccion->episodiosAgresivos()->save($episodioAgresivo);
        $episodioAgresivo->save();
        $asistido->save();

        return redirect()->route('fichaAdicciones.create',['asistido_id'=>$asistido_id]);     
    } 

    public function destroyEpisodioAgresivo($episodioAgresivo_id,$asistido_id){
        $episodioAgresivo=EpisodioAgresivo::find($episodioAgresivo_id);
        $episodioAgresivo->delete();
        return redirect()->route('fichaAdicciones.create',['asistido_id'=>$asistido_id]);
    }

    public function storeTratamiento(Request $request,$asistido_id){
        $tratamiento=new Tratamiento($request->all());
        $asistido=Asistido::find($asistido_id);
        $asistido->checkFichaAdicciones=1;
        $fichaAdiccion=$this->findFichaAdiccionByAsistidoId($asistido_id);
        $fichaAdiccion->checklistTratamiento=1;
        $fichaAdiccion->tratamientos()->save($tratamiento);
        $tratamiento->save();
        $asistido->save();

        return redirect()->route('fichaAdicciones.create',['asistido_id'=>$asistido_id]);
    }

    public function destroyTratamiento($tratamiento_id,$asistido_id){
        $tratamiento=Tratamiento::find($tratamiento_id);
        $tratamiento->delete();
        return redirect()->route('fichaAdicciones.create',['asistido_id'=>$asistido_id]);
    }

    public function storeConsideraciones(Request $request,$asistido_id){
        $fichaAdiccion=$this->findFichaAdiccionByAsistidoId($asistido_id);
        $asistido=Asistido::find($asistido_id);
        $asistido->checkFichaAdicciones=1;
        
        if(isset($request->checklistRequiereInternacion)){
            $fichaAdiccion->checklistRequiereInternacion=1;
        }
        if(isset($request->checklistRequiereDerivacion)){
            $fichaAdiccion->checklistRequiereDerivacion=1;
        }
        if(isset($request->checklistEmbarazo)){
            $fichaAdiccion->checklistEmbarazo=1;
        }

        if(isset($request->observaciones)){
            $fichaAdiccion->observaciones=$request->observaciones;
        }
        $fichaAdiccion->save();
        $asistido->save();


        return redirect()->route('asistido.show',['asistido_id'=>$asistido_id]);
        //return redirect()->route('asistido.list');

    }

    public function findFichaAdiccionByAsistidoId($asistido_id){
        $fichaAdiccion=FichaAdiccion::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(empty($fichaAdiccion)){
            $fichaAdiccion=new FichaAdiccion();
            $asistido->ficha()->save($fichaAdiccion);
        }
        return $fichaAdiccion;
    }


    public function showAdicciones(){
        $adicciones=Adiccion::all();

    }

    
}
