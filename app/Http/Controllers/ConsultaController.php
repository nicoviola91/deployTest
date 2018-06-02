<?php

namespace App\Http\Controllers;

use App\Consulta;
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
        $consulta = new Consulta($request->all());
        $consulta->user_id = 4; //TODO: ACA HAY QUE PONER EL UID DEL USUARIO LOGEADO
        $consulta->consultable_type = 'fichasMedicas'; //TODO: ACA HAY QUE PONER EL TIPO DE FICHA 
        $consulta->consultable_id = 1; //TODO: ACA HAY QUE PONER EL ID DE LA FICHA

        //$file = Storage::disk('local')->put('/consultas/archivo_prueba.txt', 'CONTENIDO');
        
        //var_dump($file);

        $consulta->save();

        var_dump($consulta);
        //return redirect()->route('alerta.list');
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
        var_dump(Auth::user());
        $data['consultas'] = Consulta::all();
        return view('consultas.listado', $data);
    }

}
