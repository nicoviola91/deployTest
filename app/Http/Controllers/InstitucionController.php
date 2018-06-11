<?php

namespace App\Http\Controllers;

use App\Institucion;
use Illuminate\Http\Request;
use App\Http\Requests\InstitucionRequest;
use Illuminate\Support\Facades\Storage;

class InstitucionController extends Controller
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
    public function store(InstitucionRequest $request)
    {           
        $institucion = new Institucion($request->all());
        $institucion->save();
        return redirect()->route('institucion.list');
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
        return view('instituciones.listado', $data);
    }

}
