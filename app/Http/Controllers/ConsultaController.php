<?php

namespace App\Http\Controllers;

use App\Consulta;
use App\Asistido;
use App\Ficha;
use App\FichaDatosPersonales;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConsultaController extends Controller
{

    public function __construct () {

        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $consulta = new Consulta([
            'mensaje' => $request->mensaje,
            'user_id' => Auth::user()->id,
        ]);

        switch ($request->tipo) {

            case 'fichasDatosPersonales':
                $ficha = FichaDatosPersonales::where('asistido_id',$request->asistido_id)->first();
                break;
            
            default:
                # code...
                break;
        }

        $file = Storage::disk('local')->put('/consultas/', 'CONTENIDO');
        
        var_dump($file);

        $ficha->consultas()->save($consulta);
        //return redirect()->route('consulta.list');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function show(Consulta $consulta)
    {
        //
    }

    /**
     * Display the specified resource list.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        echo "<br>";
        $data['consultas'] = Consulta::all();
        return view('consultas.listado', $data);
    }

    public function getView ($asistido_id, $tipo) {

        //Recibe por parametros: consultable_id (el id de la ficha), consultable_type (el tipo de ficha)
        $data['asistido_id'] = $asistido_id;
        $data['tipo'] = $tipo;
        
        switch ($tipo) {
            
            case 'fichasDatosPersonales':
                $fichaDatosPersonales = FichaDatosPersonales::where('asistido_id',$asistido_id)->first();
                if (isset($fichaDatosPersonales) && !empty($fichaDatosPersonales))
                    $consultas = $fichaDatosPersonales->consultas;
                break;
            
            default:
                $consultas = array();
                break;
        
        }

        $data['consultas'] = $consultas;

        $view = view('consultas.consultas', $data)->render();

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);
    }

}
