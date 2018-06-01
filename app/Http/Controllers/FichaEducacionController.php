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
        if(!empty($fichaEducacion)){
            $primarias=Eduacion::where('tipoEducacion_id','1')->get();
            $secundarios=Eduacion::where('tipoEducacion_id','2')->get();
            $terciarios=Eduacion::where('tipoEducacion_id','3')->get();
            $universitarios=Eduacion::where('tipoEducacion_id','4')->get();
            $cursos=Eduacion::where('tipoEducacion_id','5')->get();
            return view('altaFichas.fichaEducacion')->with('primarias',$primarias)
                ->with('secundarias',$secundarias)
                ->with('terciarias',$terciarias)
                ->with('universitarias',$universitarias)
                ->with('cursos',$cursos)
                ->with('niveles',$niveles);
        }
        return view('altaFichas.fichaEducacion')->with('asistido',$asistido)->with('niveles',$niveles);
    }

    public function storeEducacion(Request $request, $asistido_id, $tipoEducacion_id){

        $asistido=Asistido::find($asistido_id);
        $asistido->checkFichaEducacion=1;
        $fichaEducacion=$this->findFichaEducacionByAsistidoId($asistido_id);
        $tipoEducacion=TipoEducacion::find($tipoEducacion_id);

        $educacion=new Educacion($request->all());
        //mal, ver de traer los campos del request
        //todos menos los referentes a la direccion tienen que venir para la educacion
        //crear nueva instancia de direccion
        //agregar la educacion a la ficha
        //agregar la educacion al tipo de educacion
        //agregar la direccion a la educacion
        //no olvidar hacer los saves

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
