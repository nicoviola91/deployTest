<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistido;
use App\FichaLocalizacion;
use App\LocalizacionHabitual;
use App\ZonaDePermanencia;
use App\Direccion;
use Illuminate\Support\Facades\Storage;


class FichaLocalizacionController extends Controller
{

    public function __construct () {

        $this->middleware('auth');

    }

    public function create($asistido_id){
        $asistido=Asistido::find($asistido_id);
        $fichaLocalizacion=FichaLocalizacion::where('asistido_id',$asistido_id)->first();
        if(!empty($fichaLocalizacion)){
            $localizaciones=LocalizacionHabitual::where('fichaLocalizacion_id',$fichaLocalizacion->id)->get();
            $zonasDePermanencia=ZonaDePermanencia::where('fichaLocalizacion_id',$fichaLocalizacion->id)->get();
            return view('altaFichas.fichaLocalizacion')->with('localizaciones',$localizaciones)
                ->with('asistido',$asistido)
                ->with('zonas',$zonasDePermanencia)
                ->with('fichaLocalizacion',$fichaLocalizacion);
        }
        return view('altaFichas.fichaLocalizacion')->with('asistido',$asistido);
    }

    
    public function storeLocalizacion(Request $request, $asistido_id){

        $asistido=Asistido::find($asistido_id);
        $asistido->checkFichaLocalizacion=1;
        $fichaLocalizacion=$this->findFichaLocalizacionByAsistidoId($asistido_id);
        $direccionInput=$request->only('calle','numero','piso','departamento','entreCalles','localidad','provincia','codigoPostal','pais');
        $direccion= new Direccion($direccionInput);
        $tipo=$request->input('localizacionOZona');
        $input=$request->except('calle','numero','piso','departamento','entreCalles','localidad','provincia','codigoPostal','pais');
        if($tipo=='Localizacion'){
            $localizacion=new LocalizacionHabitual($input);
            $fichaLocalizacion->localizacionesHabituales()->save($localizacion);
            $localizacion->save();
            $localizacion->direccion()->save($direccion);
        } else if($tipo=='Zona'){
            $zona=new ZonaDePermanencia($input);
            $fichaLocalizacion->zonasDePermanencia()->save($zona);
            $zona->save();
            $zona->direccion()->save($direccion);
        }

        return redirect()->route('FichaLocalizacion.create',['asistido_id'=>$asistido_id]);
    
    }


    public function findFichaLocalizacionByAsistidoId($asistido_id){
        $fichaLocalizacion=FichaLocalizacion::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(empty($fichaLocalizacion)){
            $fichaLocalizacion=new FichaLocalizacion();
            $asistido->ficha()->save($fichaLocalizacion);
        }
        return $fichaLocalizacion;
    }

    public function destroyLocalizacion($id,$asistido_id,$localizacionOZona){

        if($localizacionOZona=='Localizacion'){
            $localizacion=LocalizacionHabitual::find($id);
            $direccion=Direccion::where('localizacionHabitual_id',$id)->first();
            $direccion->delete();
            $localizacion->delete();
        }else if($localizacionOZona=='Zona'){
            $zona=ZonaDePermanencia::find($id);
            $direccion=Direccion::where('zonaDePermanencia_id',$id)->first();
            $direccion->delete();
            $zona->delete();

        }
        
        return redirect()->route('FichaLocalizacion.create',['asistido_id'=>$asistido_id]);
    }

    public function destroyZonaDePermanencia($zonaDePermanencia_id,$asistido_id){

        $zonaDePermanencia=ZonaDePermanencia::find($zonaDePermanencia_id);
        $direccion=Direccion::where('zonaDePermanencia_id',$zonaDePermanencia_id)->first();
        $direccion->delete();
        $zonaDePermanencia->delete();
        return redirect()->route('FichaLocalizacion.create',['asistido_id'=>$asistido_id]);
    }
}
