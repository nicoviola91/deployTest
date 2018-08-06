<?php

namespace App\Http\Controllers;

use App\Comunidad;
use App\Institucion;
use Illuminate\Http\Request;
use App\Http\Requests\ComunidadRequest;

class ComunidadController extends Controller
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
        $comunidad = new Comunidad($request->all());
        $comunidad->save();
        
        return redirect()->back();
    }

   
    /**
     * Display the specified resource list.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $data['instituciones'] = Institucion::all();
        $data['comunidades'] = Comunidad::all();
        return view('comunidades.listado', $data);
    }

    public function show($id)
    {   
        $data['instituciones'] = Institucion::all();
        $data['comunidad'] = Comunidad::find($id);
        return view('comunidades.ficha', $data);
    }

    public function update (Request $request) {

        $comunidad = Comunidad::where('id',$request->id)->first();
        
        $comunidad->nombre = $request->nombre;
        $comunidad->cuit = $request->cuit;
        $comunidad->responsable = $request->responsable;
        $comunidad->telefono = $request->telefono;
        $comunidad->email = $request->email;
        $comunidad->tipo = $request->tipo;
        $comunidad->descripcion = $request->descripcion;

        $comunidad->save();
        
        return redirect()->back();
    }

}
