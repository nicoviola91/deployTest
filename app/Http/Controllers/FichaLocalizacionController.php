<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistido;
use App\FichaLocalizacion;
use App\LocalizacionHabitual;
use App\ZonaDePermanencia;
use App\Direccion;


class FichaLocalizacionController extends Controller
{
    public function create($asistido_id){
        $asistido=Asistido::find($asistido_id);
        $fichaLocalizacion=FichaLocalizacion::where('asistido_id',$asistido_id)->first();
        if(!empty($fichaLocalizacion)){
            $localizaciones=LocalizacionHabitual::where('fichaLocalizacion_id',$fichaLocalizacion->id)->get();
            $zonasDePermanencia=ZonaDePermanencia::where('fichaLocalizacion_id',$fichaLocalizacion->id)->get();
            return view('altaFichas.fichaLocalizacion')->with('localizaciones',$localizaciones)
                ->with('asistido',$asistido)
                ->with('zonasDePermanencia',$zonasDePermanencia)
                ->with('fichaLocalizacion',$fichaLocalizacion);
        }
        return view('altaFichas.fichaLocalizacion')->with('asistido',$asistido);
    }

    
    public function storeLocalizacion(Request $request, $asistido_id){

        $asistido=Asistido::find($asistido_id);
        $asistido->checkFichaLocalizacion=1;
        //$asistido->save();

        $fichaLocalizacion=$this->findFichaLocalizacionByAsistidoId($asistido_id);
        
        $localizacionInput=$request->except('calle','numero','piso','departamento','entreCalles','localidad','provincia','codigoPostal','pais');
        $localizacion=new LocalizacionHabitual($localizacionInput);

        
        $fichaLocalizacion->localizacionesHabituales()->save($localizacion);

        $localizacion->save();
     
        $direccionInput=$request->only('calle','numero','piso','departamento','entreCalles','localidad','provincia','codigoPostal','pais');
        $direccion= new Direccion($direccionInput);
        $localizacion->direccion()->save($direccion);



        return redirect()->route('FichaLocalizacion.create',['asistido_id'=>$asistido_id]);
     
    }

    
    public function storeZonaDePermanencia(Request $request, $asistido_id){

        $asistido=Asistido::find($asistido_id);
        $asistido->checkFichaLocalizacion=1;
        //$asistido->save();

        $fichaLocalizacion=$this->findFichaLocalizacionByAsistidoId($asistido_id);
        
        $zonaDePermanenciaInput=$request->except('calle','numero','piso','departamento','entreCalles','localidad','provincia','codigoPostal','pais');
        $zonaDePermanencia=new ZonaDePermanencia($zonaDePermanenciaInput);

        
        $ficha->zonasDePermanencia()->save($zonaDePermanenciaInput);

        $zonaDePermanenciaInput->save();
     
        $direccionInput=$request->only('calle','numero','piso','departamento','entreCalles','localidad','provincia','codigoPostal','pais');
        $direccion= new Direccion($direccionInput);
        $zonaDePermanenciaInput->direccion()->save($direccion);

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

    public function destroyLocalizacion($localizacionHabitual_id,$asistido_id){

        $localizacion=LocalizacionHabitual::find($localizacionHabitual_id);
        $direccion=Direccion::where('localizacionHabitual_id',$localizacionHabitual_id)->first();
        $direccion->delete();
        $localizacion->delete();
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
