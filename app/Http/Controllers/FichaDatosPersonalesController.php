<?php

namespace App\Http\Controllers;

use App\Ficha;
use App\FichaDatosPersonales;
use App\Asistido;
use App\Sexo;
use App\User;
use App\EstadoCivil;
use App\EstadoDocumento;
use Illuminate\Http\Request;
use App\Http\Requests\FichaDatosPersonalesRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class FichaDatosPersonalesController extends Controller
{

    public function __construct () {

        $this->middleware('auth');

    }
    
    public function create($id){
        $asistido=Asistido::find($id);
        $sexos= Sexo::all();
        $estadosDocumento = EstadoDocumento::all();
        $estadosCiviles = EstadoCivil::all();
        $fichaDatosPersonales=$this->findFichaDatosPersonalesByAsistidoId($id);
        if(isset($fichaDatosPersonales)){
            return view('altaFichas.fichaDatosPersonales2')->with('asistido',$asistido)
                ->with('fichaDatosPersonales',$fichaDatosPersonales)
                ->with('sexos',$sexos)
                ->with('estadosDocumento', $estadosDocumento)
                ->with('estadosCiviles',$estadosCiviles);
        }
        return view('altaFichas.fichaDatosPersonales2')
                ->with('asistido',$asistido)
                ->with('sexos',$sexos)
                ->with('estadosDocumento', $estadosDocumento)
                ->with('estadosCiviles',$estadosCiviles)
                ->render();
    }

    public function get ($id) {

        $asistido=Asistido::find($id);
        $fichaDatosPersonales=$this->findFichaDatosPersonalesByAsistidoId($id);
        $sexos= Sexo::all();
        $estadosDocumento = EstadoDocumento::all();
        $estadosCiviles = EstadoCivil::all();
        if(isset($fichaDatosPersonales)){
            
            $view = view('altaFichas.fichaDatosPersonales2')
                ->with('asistido',$asistido)
                ->with('fichaDatosPersonales',$fichaDatosPersonales)
                ->with('sexos',$sexos)
                ->with('estadosDocumento', $estadosDocumento)
                ->with('estadosCiviles',$estadosCiviles)
                ->render();

        } else {

           $view = view('altaFichas.fichaDatosPersonales2')->with('asistido',$asistido)->with('sexos',$sexos)->render();

        }      

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);
    }

    public function store(Request $request, $asistido_id){
        
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
            'mailContacto' => $request->input('mailContacto'),
            'sexo_id' => $request->input('sexo_id'),
            'estadoDocumento_id' => $request->input('estadoDocumento_id'),
            'estadoCivil_id' => $request->input('estadoCivil_id'),
        ]);

        $fichaDatosPersonales=$this->findFichaDatosPersonalesByAsistidoId($asistido_id);
        
        $asistido=Asistido::find($asistido_id);

        //Si cambio nombre, apellido, dni, sexo o fecha de nacimiento se cambia tambien en el asistido
        $asistido->update(['nombre' => $request->input('nombre'),'apellido' => $request->input('apellido'),'dni' => $request->input('numeroDocumento'),'fechaNacimiento' => $request->input('fechaNacimiento'), 'sexo_id' => $request->input('sexo_id')]);
        
        if ($asistido->ficha()->save($fichaDatosPersonales)) {
            
            return response()->json([
                'status' => true,
            ]);

        } else {

            return response()->json([
                'status' => false,
            ]);
        }    
    }

    // public function store(Request $request, $asistido_id){
        
    //     $partida=$request->input('tienePartida');
    //     if($partida=='on'){
    //         $value=true;
    //     }else{
    //         $value=false;
    //     }

    //     FichaDatosPersonales::where('asistido_id',$asistido_id)
    //         ->update
    //         (['nombre' => $request->input('nombre'),
    //         'apellido' => $request->input('apellido'),
    //         'numeroDocumento' => $request->input('numeroDocumento'),
    //         'fechaNacimiento' => $request->input('fechaNacimiento'),
    //         'tienePartida' => $value,
    //         'nacionalidad' => $request->input('nacionalidad'),
    //         'fechaIngresoAlPais' => $request->input('fechaIngresoAlPais'),
    //         'fechaNacimiento' => $request->input('fechaNacimiento'),
    //         'celular' => $request->input('celular'),
    //         'telefono' => $request->input('telefono'),
    //         'email' => $request->input('email'),
    //         'nombreContacto' => $request->input('nombreContacto'),
    //         'telefonoContacto' => $request->input('telefonoContacto'),
    //         'mailContacto' => $request->input('mailContacto'),
    //         'sexo_id' => $request->input('sexo_id'),
    //         'estadoDocumento_id' => $request->input('estadoDocumento_id'),
    //         'estadoCivil_id' => $request->input('estadoCivil_id'),
    //     ]);

    //     $fichaDatosPersonales=$this->findFichaDatosPersonalesByAsistidoId($asistido_id);
        
    //     $asistido=Asistido::find($asistido_id);
    //     $asistido->ficha()->save($fichaDatosPersonales);
        
    //     return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);
    // }

    public function findFichaDatosPersonalesByAsistidoId($asistido_id){
        $fichaDatosPersonales=FichaDatosPersonales::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(!isset($fichaDatosPersonales)){
            $fichaDatosPersonales = new FichaDatosPersonales();
            $fichaDatosPersonales->nombre=$asistido->nombre;
            $fichaDatosPersonales->created_by = Auth::user()->id;
            $asistido->ficha()->save($fichaDatosPersonales);
            $asistido->checkFichaDatosPersonales=1;
            $asistido->save();
        }
        return $fichaDatosPersonales;
    }

}
