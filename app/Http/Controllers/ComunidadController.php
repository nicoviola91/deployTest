<?php

namespace App\Http\Controllers;

use App\Comunidad;
use Illuminate\Http\Request;
use App\Http\Requests\ComunidadRequest;

class ComunidadController extends Controller
{
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
    public function store(ComunidadRequest $request)
    {           
        $comunidad = new Comunidad($request->all());
        $comunidad->save();
        return redirect()->route('comunidad.list');
    }

   
    /**
     * Display the specified resource list.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $data['comunidades'] = Comunidad::all();
        return view('comunidades.listado', $data);
    }

}
