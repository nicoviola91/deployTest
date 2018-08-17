<?php

namespace App\Http\Controllers;

use App\Necesidad;
use Illuminate\Http\Request;

class NecesidadesController extends Controller
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
   
    /**
     * Display the specified resource list.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $data['necesidades'] = necesidad::all();
        return view('necesidades.listado', $data);
    }

    public function public_list()
    {
        $data['necesidades'] = necesidad::all();
        return view('necesidades.listado', $data);
    }

    public function nueva_donacion()
    {

    }


}
