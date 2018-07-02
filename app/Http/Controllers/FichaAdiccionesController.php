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
use Illuminate\Support\Facades\Storage;

class FichaAdiccionesController extends Controller
{

    public function __construct () {

        $this->middleware('auth');

    }
    
    public function create($asistido_id){
        $asistido=Asistido::find($asistido_id);
        //para poder mostrar las sutancias cuando se agrega una adiccion
        $sustancias=Sustancia::all(['id','sustancia']);

        $fichaAdiccion=$this->findFichaAdiccionByAsistidoId($asistido_id);
        //en este metodo, traer las colecciones de tratamientos, episodios y adicciones, si existe la ficha
        if(isset($fichaAdiccion)){
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

    public function get($asistido_id){

        $asistido=Asistido::find($asistido_id);
        //Para poder mostrar las sutancias cuando se agrega una adiccion
        $sustancias=Sustancia::all(['id','sustancia']);

        $fichaAdiccion=$this->findFichaAdiccionByAsistidoId($asistido_id);
        
        //En este metodo, traer las colecciones de tratamientos, episodios y adicciones, si existe la ficha
        if(isset($fichaAdiccion)){
            
            $adicciones=Adiccion::where('fichaAdiccion_id',$fichaAdiccion->id)->get();
            $episodiosAgresivos=EpisodioAgresivo::where('fichaAdiccion_id',$fichaAdiccion->id)->get();
            $tratamientos=Tratamiento::where('fichaAdiccion_id',$fichaAdiccion->id)->get();

            $view = view('altaFichas.fichaAdicciones2')
            ->with('asistido',$asistido)
            ->with('sustancias',$sustancias)
            ->with('adicciones',$adicciones)
            ->with('fichaAdiccion',$fichaAdiccion)
            ->with('episodiosAgresivos',$episodiosAgresivos)
            ->with('tratamientos',$tratamientos)
            ->render();
        } else {
            $view = view('altaFichas.fichaAdicciones2')->with('asistido',$asistido)->with('sustancias',$sustancias)->render();
        }
        
        return response()->json([
            'status' => true,
            'view' => $view,
        ]);

    }

    public function storeAdiccion(Request $request, $asistido_id){
        //falta obtener lo que esta dentro del dropdown , no lo esta agarrando
        //Con update me aseguro de no generar duplicados y solo actualizar el registro existente
        Asistido::where('id',$asistido_id)->update(['checkFichaAdicciones' =>1]);

        $sustancias=Sustancia::all(['id','sustancia']);
        $fichaAdiccion=$this->findFichaAdiccionByAsistidoId($asistido_id);
        FichaAdiccion::where('asistido_id',$asistido_id)
        ->update(['checklistAdicciones'=>1]);

        $adiccion=new Adiccion($request->all());
        //fichaAdiccion_id en la clase adiccion tiene que ser fillable para que funcione con Eloquent
        $fichaAdiccion->adicciones()->save($adiccion);
        //$adiccion->fichaAdiccion()->save($fichaAdiccion);
        $adiccion->save();

        return redirect()->route('fichaAdicciones.create',['asistido_id'=>$asistido_id]);       
    }

    public function destroyAdiccion(Request $request){

        $adiccion_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $adiccion=Adiccion::find($adiccion_id);
        $adiccion->delete();
        return redirect()->route('fichaAdicciones.create',['asistido_id'=>$asistido_id]);

}

    public function storeEpisodioAgresivo(Request $request, $asistido_id){
        $episodioAgresivo=new EpisodioAgresivo($request->all());
        Asistido::where('id',$asistido_id)->update(['checkFichaAdicciones' =>1]);
        $fichaAdiccion=$this->findFichaAdiccionByAsistidoId($asistido_id);
        FichaAdiccion::where('asistido_id',$asistido_id)
        ->update(['checklistEpisodiosAgresivos'=>1]);
        $fichaAdiccion->episodiosAgresivos()->save($episodioAgresivo);
        $episodioAgresivo->save();

        return redirect()->route('fichaAdicciones.create',['asistido_id'=>$asistido_id]);     
    } 

    public function destroyEpisodioAgresivo(Request $request){

        $episodioAgresivo_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $episodioAgresivo=EpisodioAgresivo::find($episodioAgresivo_id);
        $episodioAgresivo->delete();
        return redirect()->route('fichaAdicciones.create',['asistido_id'=>$asistido_id]);
    }

    public function storeTratamiento(Request $request,$asistido_id){
        $tratamiento=new Tratamiento($request->all());
        Asistido::where('id',$asistido_id)->update(['checkFichaAdicciones' =>1]);
        $fichaAdiccion=$this->findFichaAdiccionByAsistidoId($asistido_id);
        FichaAdiccion::where('asistido_id',$asistido_id)
        ->update(['checklistTratamiento'=>1]);
        $fichaAdiccion->tratamientos()->save($tratamiento);
        $tratamiento->save();

        return redirect()->route('fichaAdicciones.create',['asistido_id'=>$asistido_id]);
    }

    public function destroyTratamiento(Request $request){
        
        $tratamiento_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $tratamiento=Tratamiento::find($tratamiento_id);
        $tratamiento->delete();
        return redirect()->route('fichaAdicciones.create',['asistido_id'=>$asistido_id]);
    }

    public function storeConsideraciones(Request $request,$asistido_id){
        $fichaAdiccion=$this->findFichaAdiccionByAsistidoId($asistido_id);
        Asistido::where('id',$asistido_id)->update(['checkFichaAdicciones' =>1]);

        $requiereInternacion=$request->input('checklistRequiereInternacion');
        if($requiereInternacion=='on'){
            $requiereInternacionValue=1;
        }else{
            $requiereInternacionValue=0;
        }
        $requiereDerivacion=$request->input('checklistRequiereDerivacion');
        if($requiereDerivacion=='on'){
            $requiereDerivacionValue=1;
        }else{
            $requiereDerivacionValue=0;
        }
        $embarazo=$request->input('checklistEmbarazo');
        if($embarazo=='on'){
            $checklistEmbarazoValue=1;
        }else{
            $checklistEmbarazoValue=0;
        }
        FichaAdiccion::where('asistido_id',$asistido_id)
        ->update(['checklistRequiereInternacion'=>$requiereInternacionValue, 'checklistRequiereDerivacion'=>$requiereDerivacionValue,'checklistEmbarazo'=>$checklistEmbarazoValue,
        'observaciones' =>$request->observaciones]);
        return redirect()->route('asistido.show',['asistido_id'=>$asistido_id]);

    }

    public function findFichaAdiccionByAsistidoId($asistido_id){
        $fichaAdiccion=FichaAdiccion::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(!isset($fichaAdiccion)){
            $fichaAdiccion=new FichaAdiccion();
            $asistido->ficha()->save($fichaAdiccion);
        }
        return $fichaAdiccion;
    }


    
}
