<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistido;
use App\FichaEducacion;
use App\Educacion;
use App\Direccion;
use App\TipoEducacion;



class FichaEducacionController extends Controller
{
    public function create($asistido_id){
        
        $asistido=Asistido::find($asistido_id);
        $fichaEducacion=FichaEducacion::where('asistido_id',$asistido_id)->first();
        $niveles=array('Completo','Incompleto','En curso','Nunca iniciado');
        $tipos=array('Primario','Secundario','Terciario','Universitario','Curso');
        $orientaciones=array('Agrario', 'Arte', 'Comunicación', 'Turismo', 'Lenguas', 'Informática', 'Educación Física',
        'Ciencias Naturales', 'Ciencias Sociales y Humanidades','Economía y Administración');
        if(!empty($fichaEducacion)){
            $primarias=Educacion::where('tipoEducacion_id','1')->get();
            $secundarios=Educacion::where('tipoEducacion_id','2')->get();
            $terciarios=Educacion::where('tipoEducacion_id','3')->get();
            $universitarios=Educacion::where('tipoEducacion_id','4')->get();
            $cursos=Educacion::where('tipoEducacion_id','5')->get();
           
            return view('altaFichas.fichaEducacion')->with('primarias',$primarias)
                ->with('fichaEducacion',$fichaEducacion)
                ->with('asistido',$asistido)
                ->with('secundarios',$secundarios)
                ->with('terciarios',$terciarios)
                ->with('universitarios',$universitarios)
                ->with('cursos',$cursos)
                ->with('niveles',$niveles)
                ->with('orientaciones',$orientaciones)
                ->with('tipos',$tipos);
        }
        return view('altaFichas.fichaEducacion')->with('asistido',$asistido)->with('niveles',$niveles)->with('orientaciones',$orientaciones)->with('tipos',$tipos);
    }

    public function storeEducacion(Request $request, $asistido_id){

        $asistido=Asistido::find($asistido_id);
        $asistido->checkFichaEducacion=1;
        //$asistido->save();

        $fichaEducacion=$this->findFichaEducacionByAsistidoId($asistido_id);
        $fichaEducacion->checklistPrimaria=1;

        $educacionInput=$request->except('calle','numero','piso','departamento','entreCalles','localidad','provincia','codigoPostal','pais');
        $educacion=new Educacion($educacionInput);

        if($educacion->tipo=='Primario'){
            $tipoEducacion_id=1;
        }
        if($educacion->tipo=='Secundario'){
            $tipoEducacion_id=2;
        }
        if($educacion->tipo=='Terciario'){
            $tipoEducacion_id=3;
        }
        if($educacion->tipo=='Universitario'){
            $tipoEducacion_id=4;
        }
        if($educacion->tipo=='Curso'){
            $tipoEducacion_id=5;
        }

        $tipoEducacion=TipoEducacion::find($tipoEducacion_id);
        
        $direccionInput=$request->only('calle','numero','piso','departamento','entreCalles','localidad','provincia','codigoPostal','pais');
        $direccion= new Direccion($direccionInput);
        
        $fichaEducacion->educaciones()->save($educacion);
        $tipoEducacion->educaciones()->save($educacion);
        $educacion->direccion()->save($direccion);



        return redirect()->route('fichaEducacion.create',['asistido_id'=>$asistido_id]);
     
    }

    public function findFichaEducacionByAsistidoId($asistido_id){
        $fichaEducacion=FichaEducacion::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(empty($fichaEducacion)){
            $fichaEducacion=new FichaEducacion();
            $asistido->ficha()->save($fichaEducacion);
        }
        return $fichaEducacion;

    }
}
