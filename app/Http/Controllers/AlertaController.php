<?php

namespace App\Http\Controllers;

use App\Alerta;
use Illuminate\Http\Request;
use App\Http\Requests\AlertaRequest;

class AlertaController extends Controller
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
    public function store(AlertaRequest $request)
    {           
        $alerta = new Alerta($request->all());
        $alerta->user_id = 5; //ACA HAY QUE PONER EL UID DEL USUARIO LOGEADO
        $alerta->save();

        var_dump($alerta);
        //return view('auth.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alerta  $alerta
     * @return \Illuminate\Http\Response
     */
    public function show(Alerta $alerta)
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
        $data['alertas'] = Alerta::all();
        return view('alertas.listado', $data);
    }

    /**
     * Display the specified resource list.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function showMap()
    {
        $data['alertas'] = Alerta::all();
        return view('alertas.map', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alerta  $alerta
     * @return \Illuminate\Http\Response
     */
    public function edit(Alerta $alerta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alerta  $alerta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alerta $alerta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alerta  $alerta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alerta $alerta)
    {
        //
    }
}
