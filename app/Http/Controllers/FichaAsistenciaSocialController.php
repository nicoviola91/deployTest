<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServicioSocial;
use App\Asistido;
use App\FichaAsistenciaSocial;

class FichaAsistenciaSocialController extends Controller
{
    public function __construct () {

        $this->middleware('auth');

    }
    
    public function create($asistido_id){
        $asistido=Asistido::find($asistido_id);
        $fichaAsistenciaSocial=$this->findFichaAsistenciaSocialByAsistidoId($asistido_id);
        if(isset($fichaAsistenciaSocial)){
            $servicios=ServicioSocial::where('fichaAsistenciaSocial_id',$fichaAsistenciaSocial->id)->get();
            return view('altaFichas.fichaAsistenciaSocial')
                ->with('asistido',$asistido)
                ->with('servicios',$servicios);
        }
        return view('altaFichas.fichaAsistenciaSocial')->with('asistido',$asistido);
    }

    public function get ($asistido_id) {

        $asistido=Asistido::find($asistido_id);

        $fichaAsistenciaSocial=$this->findFichaAsistenciaSocialByAsistidoId($asistido_id);
        
        if(isset($fichaAsistenciaSocial)){
        
            $servicios=ServicioSocial::where('fichaAsistenciaSocial_id',$fichaAsistenciaSocial->id)->get();
        
            $view = view('altaFichas.fichaAsistenciaSocial')
                ->with('asistido',$asistido)
                ->with('servicios',$servicios)
                ->render();
        }

        $view = view('altaFichas.fichaAsistenciaSocial')->with('asistido',$asistido)->render();

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);
    }

    public function storeServicio(Request $request, $asistido_id){

        $servicio=new ServicioSocial($request->all());
        Asistido::where('id',$asistido_id)->update(['checkFichaAsistenciaSocial' =>1]);
        $fichaAsistenciaSocial=$this->findFichaAsistenciaSocialByAsistidoId($asistido_id);
        FichaAsistenciaSocial::where('asistido_id',$asistido_id)
        ->update(['checklistAsistenciaSocial'=>1]);
        $fichaAsistenciaSocial->serviciosSociales()->save($servicio);
        $servicio->save();

        return redirect()->route('fichaAsistenciaSocial.create',['asistido_id'=>$asistido_id]); 

    }

    
    public function destroyServicio($id,$asistido_id){

        $servicio=ServicioSocial::find($id);
        $servicio->delete();
        return redirect()->route('fichaAsistenciaSocial.create',['asistido_id'=>$asistido_id]);
    }



    public function findFichaAsistenciaSocialByAsistidoId($asistido_id){
        $fichaAsistenciaSocial=FichaAsistenciaSocial::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(!isset($fichaAsistenciaSocial)){
            $fichaAsistenciaSocial=new FichaAsistenciaSocial();
            $asistido->ficha()->save($fichaAsistenciaSocial);
        }
        return $fichaAsistenciaSocial;
    }
}
