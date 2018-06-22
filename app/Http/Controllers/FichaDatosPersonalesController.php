<?php

namespace App\Http\Controllers;

use App\Ficha;
use App\FichaDatosPersonales;
use App\Asistido;
use Illuminate\Http\Request;
use App\Http\Requests\FichaDatosPersonalesRequest;
use Illuminate\Support\Facades\Storage;


class FichaDatosPersonalesController extends Controller
{

    public function __construct () {

        $this->middleware('auth');

    }
    
    public function create($id){
        $asistido=Asistido::find($id);
        $fichaDatosPersonales=$this->findFichaDatosPersonalesByAsistidoId($id);
        if(isset($fichaDatosPersonales)){
            return view('altaFichas.fichaDatosPersonales')->with('asistido',$asistido)
                ->with('fichaDatosPersonales',$fichaDatosPersonales);
        }
      
        return view('altaFichas.fichaDatosPersonales')->with('asistido',$asistido);
    }

    public function get ($id) {

        $asistido=Asistido::find($id);
        $fichaDatosPersonales=$this->findFichaDatosPersonalesByAsistidoId($id);
        
        if(isset($fichaDatosPersonales)){
            
            $view = view('altaFichas.fichaDatosPersonales2')
                ->with('asistido',$asistido)
                ->with('fichaDatosPersonales',$fichaDatosPersonales)
                ->render();
        }
      
        $view = view('altaFichas.fichaDatosPersonales2')->with('asistido',$asistido)->render();

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);
    }

    public function store(Request $request, $asistido_id){
        //udpateOrCreate actualiza el registro si este ya existe, si no lo crea.
        //el primer parametro es el where, el segundo los datos que queremos actualizar en el registro
        //en este caso, buscamos una fichaDatosPersonales donde el asistido_id sea el $asistido_id
        $partida=$request->input('tienePartida');
        if($partida=='on'){
            $value=true;
        }else{
            $value=false;
        }

        FichaDatosPersonales::where('asistido_id',$asistido_id)
            ->update
            (['nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'numeroDocumento' => $request->input('numeroDocumento'),
            'fechaNacimiento' => $request->input('fechaNacimiento'),
            'tienePartida' => $value,
            'nacionalidad' => $request->input('nacionalidad'),
            'fechaIngresoAlPais' => $request->input('fechaIngresoAlPais'),
            'fechaNacimiento' => $request->input('fechaNacimiento'),
            'celular' => $request->input('celular'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email'),
            'nombreContacto' => $request->input('nombreContacto'),
            'telefonoContacto' => $request->input('telefonoContacto'),
            'mailContacto' => $request->input('mailContacto')]);
        $fichaDatosPersonales=$this->findFichaDatosPersonalesByAsistidoId($asistido_id);
        $asistido=Asistido::find($asistido_id);
        $asistido->checkFichaDatosPersonales=1;
        $asistido->ficha()->save($fichaDatosPersonales);
        return redirect()->route('asistido.show',['asistido_id'=>$asistido_id]);
    }

    public function findFichaDatosPersonalesByAsistidoId($asistido_id){
        $fichaDatosPersonales=FichaDatosPersonales::where('asistido_id',$asistido_id)->first();
        if(!isset($fichaDatosPersonales)){
            $fichaDatosPersonales=new FichaDatosPersonales();
        }
        return $fichaDatosPersonales;
    }

}
