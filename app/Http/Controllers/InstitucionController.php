<?php

namespace App\Http\Controllers;

use App\Institucion;
use App\Direccion;
use App\Comunidad;
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
    public function store(Request $request)
    {    
        //validar datos del request      

        //Direccion
        $direccion = new Direccion();

        $direccion->calle = $request->calle;
        $direccion->numero = $request->numero;
        $direccion->piso = $request->piso;
        $direccion->departamento = $request->departamento;
        $direccion->provincia = $request->provincia;
        $direccion->codigoPostal = $request->codigoPostal;
        $direccion->pais = $request->pais;
        $direccion->localidad = $request->localidad;
        $direccion->lat = $request->lat;
        $direccion->long = $request->lng;

        $direccion->save();

        //Institucion
        $institucion = new Institucion();
        
        $institucion->nombre = $request->nombre;
        $institucion->cuit = $request->cuit;
        $institucion->responsable = $request->responsable;
        $institucion->telefono = $request->telefono;
        $institucion->email = $request->email;
        $institucion->tipo = $request->tipo;
        $institucion->descripcion = $request->descripcion;
        $institucion->direccion_id = $direccion->id;

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

    public function getBox ($id) {

        $data['institucion'] = Institucion::where('id', $id)->first();

        $comunidades = $data['institucion']->comunidades();
        $data['comunidades'] = $comunidades->count();

        $asistidos = 0;
        
        foreach ($comunidades as $comunidad) {
            $asistidos+= ($comunidad->asistidos()->count());
        }

        $data['asistidos'] = $asistidos;

        $view = view('instituciones.boxInstitucion', $data)->render();

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);

    }

}
