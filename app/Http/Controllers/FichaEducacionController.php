<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistido;
use App\FichaEducacion;
use App\Educacion;
use App\Direccion;
use App\User;
use App\TipoEducacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class FichaEducacionController extends Controller
{

    public function __construct () {

        $this->middleware('auth');

    }
    
    public function create($asistido_id){
        
        $asistido =Asistido::find($asistido_id);
        $fichaEducacion =$this->findFichaEducacionByAsistidoId($asistido_id);
        
        $niveles=array('Completo','Incompleto','En curso','Nunca iniciado');
        $tipos=array('Primario','Secundario','Terciario','Universitario','Curso');
        $orientaciones=array('Agrario', 'Arte', 'Comunicación', 'Turismo', 'Lenguas', 'Informática', 'Educación Física',
        'Ciencias Naturales', 'Ciencias Sociales y Humanidades','Economía y Administración');
        
        if(!empty($fichaEducacion)){
            
            $educaciones=Educacion::where('ficha_educacion_id',$fichaEducacion->id)->get();
            
            return view('altaFichas.fichaEducacion')
                ->with('educaciones',$educaciones)
                ->with('fichaEducacion',$fichaEducacion)
                ->with('asistido',$asistido)
                ->with('niveles',$niveles)
                ->with('orientaciones',$orientaciones)
                ->with('tipos',$tipos);
        }
        return view('altaFichas.fichaEducacion')->with('asistido',$asistido)->with('niveles',$niveles)->with('orientaciones',$orientaciones)->with('tipos',$tipos);
    }

    public function get ($asistido_id) {
        
        $asistido=Asistido::find($asistido_id);
        $fichaEducacion=$this->findFichaEducacionByAsistidoId($asistido_id);
        
        $niveles=array('Completo','Incompleto','En curso','Nunca iniciado');
        $tipos=array('Primario','Secundario','Terciario','Universitario','Curso');
        $orientaciones=array('Agrario', 'Arte', 'Comunicación', 'Turismo', 'Lenguas', 'Informática', 'Educación Física',
        'Ciencias Naturales', 'Ciencias Sociales y Humanidades','Economía y Administración');
        
        if(!empty($fichaEducacion)){
            
            $educaciones=Educacion::where('ficha_educacion_id',$fichaEducacion->id)->get();
            
            $view = view('altaFichas.fichaEducacion2')
                ->with('educaciones',$educaciones)
                ->with('fichaEducacion',$fichaEducacion)
                ->with('asistido',$asistido)
                ->with('niveles',$niveles)
                ->with('orientaciones',$orientaciones)
                ->with('tipos',$tipos)
                ->render();
        } else {
            
            $view = view('altaFichas.fichaEducacion2')->with('asistido',$asistido)->with('niveles',$niveles)->with('orientaciones',$orientaciones)->with('tipos',$tipos)->render();
        }

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);
    }

    public function storeEducacion(Request $request, $asistido_id){

        Asistido::where('id',$asistido_id)->update(['checkFichaEducacion' =>1]);

        $fichaEducacion=$this->findFichaEducacionByAsistidoId($asistido_id);
        
        $educacionInput=$request->except('calle','numero','piso','departamento','entreCalles','localidad','provincia','codigoPostal','pais');
        $educacion=new Educacion($educacionInput);
  
        if($request->input('tipoEducacion') =='Primario'){
            $tipoEducacion_id=1;
        }
        if($request->input('tipoEducacion')=='Secundario'){
            $tipoEducacion_id=2;
        }
        if($request->input('tipoEducacion')=='Terciario'){
            $tipoEducacion_id=3;
        }
        if($request->input('tipoEducacion')=='Universitario'){
            $tipoEducacion_id=4;
        }
        if($request->input('tipoEducacion')=='Curso'){
            $tipoEducacion_id=5;
        }

        $tipoEducacion=TipoEducacion::find($tipoEducacion_id);
        $fichaEducacion->educaciones()->save($educacion);

        $educacion->tipo()->associate($tipoEducacion);
        $educacion->save();
     
        $direccionInput=$request->only('calle','numero','piso','departamento','entreCalles','localidad','provincia','codigoPostal','pais');
        $direccion= new Direccion($direccionInput);
        $educacion->direccion()->save($direccion);
        return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);
        //return redirect()->route('fichaEducacion.create',['asistido_id'=>$asistido_id]);
     
    }

    public function findFichaEducacionByAsistidoId($asistido_id){
        $fichaEducacion=FichaEducacion::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(empty($fichaEducacion)){
            $fichaEducacion=new FichaEducacion();
            $fichaEducacion->created_by = Auth::user()->id;
            $asistido->ficha()->save($fichaEducacion);
        }

        return $fichaEducacion;

    }

    public function destroyEducacion(Request $request){

        $educacion_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $educacion=Educacion::find($educacion_id);
        $direccion=Direccion::where('educacion_id',$educacion_id)->first();
        if(isset($direccion)){
            $direccion->delete();
        }
        if($asistido->checkFichaAdicciones = 0){
            $asistido->checkFichaAdicciones = 1;
            $asistido->save();
        }
        $educacion->delete();
        //return redirect()->route('fichaEducacion.create',['asistido_id'=>$asistido_id]);
        return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);
    }



}
