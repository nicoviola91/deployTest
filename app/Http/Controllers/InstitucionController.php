<?php

namespace App\Http\Controllers;

use App\Institucion;
use App\Direccion;
use App\Comunidad;
use Illuminate\Http\Request;
use App\Http\Requests\InstitucionRequest;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\DB;

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

    public function show($id)
    {
        $data['institucion'] = Institucion::find($id);
        return view('instituciones.ficha', $data);
    }

    public function getBox ($id) {

        $data['institucion'] = Institucion::where('id', $id)->first();

        $comunidades = $data['institucion']->comunidades();
        $data['comunidades'] = $comunidades->count();

        $data['asistidos'] = count(DB::select('SELECT DISTINCT asistido_comunidad.asistido_id FROM asistido_comunidad INNER JOIN comunidades ON comunidades.id = asistido_comunidad.comunidad_id WHERE comunidades.institucion_id = :id', ['id' => 1]));
        $data['miembros'] = count(DB::select('SELECT DISTINCT user_id FROM comunidad_user INNER JOIN comunidades ON comunidades.id = comunidad_user.comunidad_id WHERE comunidades.institucion_id = :id', ['id' => 1]));

        $view = view('instituciones.boxInstitucion', $data)->render();

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);

    }

    public function update (Request $request) {

        $institucion = Institucion::where('id',$request->id)->first();
        
        $institucion->nombre = $request->nombre;
        $institucion->cuit = $request->cuit;
        $institucion->responsable = $request->responsable;
        $institucion->telefono = $request->telefono;
        $institucion->email = $request->email;
        $institucion->tipo = $request->tipo;
        $institucion->descripcion = $request->descripcion;

        $institucion->save();
        
        return redirect()->back();
    }

    public function updateDireccion (Request $request) {

        $institucion = Institucion::where('id',$request->id)->first();
        
        if (isset($institucion->direccion_id)) {
            
            $direccion = Direccion::where('id',$institucion->direccion_id)->first();
        
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


        } else {

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
            $institucion->update(['direccion_id' => $direccion->id]);
        }
        
        return redirect()->back();
    }

    public function updateImage (Request $request) {

        $validation = $request->validate([
            'foto' => 'required|file|mimes:jpeg,png,gif|max:20480'
        ]);

        $id = $request->id;
        $institucion = Institucion::where('id', $id)->first();

        if($request->hasFile('foto')) {

            //Si existe una imagen anterior, la elimino
            if (isset($institucion->imagen) && $institucion->imagen != '' && $institucion->imagen != 'default.jpg'){
                
                if (file_exists(storage_path('app/public').'/'.$institucion->imagen))
                    unlink(storage_path('app/public').'/'.$institucion->imagen);
            }

            $image = $request->file('foto');
            $imageName = $image->getClientOriginalName();
            $fileName =  "institucion_" . sha1(microtime()) . '.' . pathinfo($imageName, PATHINFO_EXTENSION);

            $directory = storage_path('app/public');
            $imageUrl = $directory.'/'.$fileName;
            Image::make($image)->fit(200, 200)->save($imageUrl);

            if ($institucion->update(['imagen' => $fileName]))
                return redirect()->back()->with('success','Actualizada correctamente.');
            else
                return redirect()->back()->with('error', 'Ocurrió un error al actualizar la imagen. Por favor vuelva a intentarlo.');
        } else {

            redirect()->back()->with('error', 'Ocurrió un error al actualizar la imagen. Debe seleccionar una imagen.');
        }

    }

}
