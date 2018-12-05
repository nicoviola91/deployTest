<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleo;
use App\FichaEmpleo;
use App\Direccion;
use App\Asistido;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FichaEmpleoController extends Controller
{
    public function __construct () {

        $this->middleware('auth');

    }

    public function create($asistido_id){
        
        $asistido=Asistido::find($asistido_id);
        $fichaEmpleo=FichaEmpleo::where('asistido_id',$asistido_id)->first();
        
        if(!empty($fichaEmpleo)){
            $empleos=Empleo::where('fichaEmpleo_id',$fichaEmpleo->id)->get();
            return view('altaFichas.fichaEmpleo')->with('empleos',$empleos)
                ->with('asistido',$asistido)
                ->with('fichaEmpleo',$fichaEmpleo);
        }
        
        return view('altaFichas.fichaEmpleo')->with('asistido',$asistido)->with('fichaEmpleo',$fichaEmpleo);
    }

    public function get ($id) {

        $asistido=Asistido::find($id);
        $fichaEmpleo=FichaEmpleo::where('asistido_id',$id)->first();
        
        if(isset($fichaEmpleo) && !empty($fichaEmpleo)){
            
            $empleos=Empleo::where('fichaEmpleo_id',$fichaEmpleo->id)->get();
            
            $view = view('altaFichas.fichaEmpleo2')->with('empleos',$empleos)
                ->with('asistido',$asistido)
                ->with('fichaEmpleo',$fichaEmpleo)
                ->render();

        } else {

           $view = view('altaFichas.fichaEmpleo2')->with('asistido',$asistido)->with('fichaEmpleo',$fichaEmpleo)->render();

        }      

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);
    }
    
    public function storeEmpleo(Request $request, $asistido_id){

        Asistido::where('id',$asistido_id)->update(['checkFichaEmpleo'=>1]);
        
        $fichaEmpleo = $this->findFichaEmpleoByAsistidoId($asistido_id);

        $direccionInput = $request->only('calle','numero','piso','departamento','entreCalles','localidad','provincia','codigoPostal','pais');
        $direccion = new Direccion ($direccionInput);
        $direccion->save();
    
        $empleoInput = $request->except('calle','numero','piso','departamento','entreCalles','localidad','provincia','codigoPostal','pais');
        
        $empleo = new Empleo($empleoInput);
        $empleo->fichaEmpleo_id = $fichaEmpleo->id;
        $empleo->direccion_id = $direccion->id;

        //$fichaEmpleo->empleos()->save($empleo);
        $empleo->save();
        //$empleo->direccion()->save($direccion);
                
        return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);
    
    }

    public function storeConsideraciones(Request $request, $asistido_id){

        if($request->input('checklistTieneEmpleo')=='on'){
            $value=1;
        }else{
            $value=0;
        }
        
        $fichaEmpleo=$this->findFichaEmpleoByAsistidoId($asistido_id);
        
        Asistido::where('id',$asistido_id)->update(['checkFichaEmpleo' =>1]);
        
        $ficha = FichaEmpleo::where('asistido_id',$asistido_id);

        if ($ficha->update(['checklistTieneEmpleo'=>$value])) {
            
            return response()->json([
                'status' => true,
            ]);

        } else {
            
            return response()->json([
                'status' => false,
            ]);
        }
        
    }


    public function findFichaEmpleoByAsistidoId($asistido_id){
        $fichaEmpleo=FichaEmpleo::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(empty($fichaEmpleo)){
            $fichaEmpleo=new FichaEmpleo();
            $fichaEmpleo->created_by = Auth::user()->id;
            $asistido->ficha()->save($fichaEmpleo);
            $asistido->update(['checkFichaEmpleo' =>1]);
        }
        return $fichaEmpleo;
    }

    public function destroyEmpleo(Request $request){

        $empleo_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $empleo=Empleo::find($empleo_id);
        $direccion=Direccion::where('empleo_id',$empleo_id)->first();
        if(isset($direccion)){
            $direccion->delete();
        }
        $empleo->delete();
        //return redirect()->route('fichaEmpleo.create',['asistido_id'=>$asistido_id]);
        return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);
    }

}

