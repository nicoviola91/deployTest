<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoDeAccion;
use App\Asistido;
use App\FichaDiagnosticoIntegral;
use Illuminate\Support\Facades\Auth;

class FichaDiagnosticoIntegralController extends Controller
{
    public function __construct () {

        $this->middleware('auth');

    }
    
    public function create($asistido_id){
        $asistido=Asistido::find($asistido_id);
        $fichaDiagnosticoIntegral=$this->findfichaDiagnosticoIntegralByAsistidoId($asistido_id);

        if(isset($fichaDiagnosticoIntegral)){
            $cursos=CursoDeAccion::where('fichaDiagnosticoIntegral_id',$fichaDiagnosticoIntegral->id)->get();
            return view('altaFichas.fichaDiagnosticoIntegral')
                ->with('asistido',$asistido)
                ->with('fichaDiagnosticoIntegral',$fichaDiagnosticoIntegral)
                ->with('cursos',$cursos);
        }
        return view('altaFichas.fichaDiagnosticoIntegral')->with('asistido',$asistido);
    }

    public function get ($asistido_id) {

        $asistido=Asistido::find($asistido_id);

        $fichaDiagnosticoIntegral=$this->findfichaDiagnosticoIntegralByAsistidoId($asistido_id);
        
        if(isset($fichaDiagnosticoIntegral)){
        
            $cursos=CursoDeAccion::where('fichaDiagnosticoIntegral_id',$fichaDiagnosticoIntegral->id)->get();
        
            $view = view('altaFichas.fichaDiagnosticoIntegral')
                ->with('asistido',$asistido)
                ->with('cursos',$cursos)
                ->with('fichaDiagnosticoIntegral',$fichaDiagnosticoIntegral)
                ->render();
        }

        $view = view('altaFichas.fichaDiagnosticoIntegral')->with('asistido',$asistido)->render();

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);
    }

    public function storeCurso(Request $request, $asistido_id){

        $curso=new CursoDeAccion($request->all());
        Asistido::where('id',$asistido_id)->update(['checkFichaDiagnosticoIntegral' =>1]);
        $fichaDiagnosticoIntegral=$this->findfichaDiagnosticoIntegralByAsistidoId($asistido_id);
        FichaDiagnosticoIntegral::where('asistido_id',$asistido_id)
        ->update(['checklistCursoDeAccion'=>1]);
        $fichaDiagnosticoIntegral->cursosDeAccion()->save($curso);
        $curso->save();

        return redirect()->route('fichaDiagnosticoIntegral.create',['asistido_id'=>$asistido_id]); 

    }

    public function storeDiagnostico(Request $request, $asistido_id){

        
        FichaDiagnosticoIntegral::where('asistido_id',$asistido_id)
        ->update(['diagnostico'=>$request->input('diagnostico'),
        'trabajoInterdisciplinario'=>$request->input('trabajoInterdisciplinario')]);
        $fichaDiagnosticoIntegral=$this->findfichaDiagnosticoIntegralByAsistidoId($asistido_id);
        $asistido=Asistido::find($asistido_id);
        $asistido->checkFichaDiagnosticoIntegral=1;
        $asistido->ficha()->save($fichaDiagnosticoIntegral);
        return redirect()->route('fichaDiagnosticoIntegral.create',['asistido_id'=>$asistido_id]); 

    }

    
    public function destroyCurso(Request $request){

        $curso_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $curso=CursoDeAccion::find($curso_id);
        $curso->delete();
        return redirect()->route('fichaDiagnosticoIntegral.create',['asistido_id'=>$asistido_id]);
    }



    public function findfichaDiagnosticoIntegralByAsistidoId($asistido_id){
        $fichaDiagnosticoIntegral=FichaDiagnosticoIntegral::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(!isset($fichaDiagnosticoIntegral)){
            $fichaDiagnosticoIntegral=new FichaDiagnosticoIntegral();
            $fichaDiagnosticoIntegral->created_by = Auth::user()->id;
            $asistido->ficha()->save($fichaDiagnosticoIntegral);
            $asistido->update(['checkFichaDiagnosticoIntegral' =>1]);
        }
        return $fichaDiagnosticoIntegral;
    }
}
