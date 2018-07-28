<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoNecesidad;
use App\FichaNecesidad;
use App\Necesidad;
use App\Asistido;
use Illuminate\Support\Facades\Auth;

class FichaNecesidadesController extends Controller
{
    
    public function __construct () {

        $this->middleware('auth');

    }
    
    public function create($asistido_id){
        $asistido=Asistido::find($asistido_id);
        $tiposNecesidades=TipoNecesidad::all(['id','descripcion']);
        $fichaNecesidad=$this->findFichaNecesidadByAsistidoId($asistido_id);
        if(isset($fichaNecesidad)){
            $necesidades=Necesidad::where('fichaNecesidad_id',$fichaNecesidad->id)->get();
            return view('altaFichas.fichaNecesidades')
                ->with('asistido',$asistido)
                ->with('tiposNecesidades',$tiposNecesidades)
                ->with('necesidades',$necesidades);
        }
        return view('altaFichas.fichaNecesidades')->with('asistido',$asistido)->with('tiposNecesidades',$tiposNecesidades);
    }


    public function get ($asistido_id){
        
        $asistido=Asistido::find($asistido_id);
        $tiposNecesidades=TipoNecesidad::all(['id','descripcion']);
        $fichaNecesidad=$this->findFichaNecesidadByAsistidoId($asistido_id);
        
        if(isset($fichaNecesidad)){

            $necesidades=Necesidad::where('fichaNecesidad_id',$fichaNecesidad->id)->get();
            $view = view('altaFichas.fichaNecesidades2')
                ->with('asistido',$asistido)
                ->with('tiposNecesidades',$tiposNecesidades)
                ->with('necesidades',$necesidades)
                ->render();
        } else {
            
            $view = view('altaFichas.fichaNecesidades2')->with('asistido',$asistido)->with('tiposNecesidades',$tiposNecesidades);
        }

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);
    }

    public function storeNecesidad(Request $request, $asistido_id){

        $necesidad=new Necesidad($request->all());
        Asistido::where('id',$asistido_id)->update(['checkFichaNecesidad' =>1]);
        $fichaNecesidad=$this->findFichaNecesidadByAsistidoId($asistido_id);
        FichaNecesidad::where('asistido_id',$asistido_id)
        ->update(['checklistNecesidades'=>1]);
        $fichaNecesidad->necesidades()->save($necesidad);
        $necesidad->save();

        return redirect()->route('fichaNecesidades.create',['asistido_id'=>$asistido_id]); 

    }

    
    public function destroyNecesidad(Request $request){

        $necesidad_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $necesidad=Necesidad::find($necesidad_id);
        $necesidad->delete();
        return redirect()->route('fichaNecesidades.create',['asistido_id'=>$asistido_id]);
    }



    public function findFichaNecesidadByAsistidoId($asistido_id){
        
        $fichaNecesidad=FichaNecesidad::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        
        if(!isset($fichaNecesidad)){
            $fichaNecesidad=new FichaNecesidad();
            $fichaNecesidad->created_by = Auth::user()->id;
            $asistido->ficha()->save($fichaNecesidad);
            $asistido->update(['checkFichaNecesidad' =>1]);
        }
        
        return $fichaNecesidad;
    }
}
