<?php

namespace App\Http\Controllers;

use App\Alerta;
use App\Institucion;
use App\Comunidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AlertaRequest;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class AlertaController extends Controller
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
        $user=Auth::user();
        $instituciones = Institucion::where('tipo', '=', 'posadero')->get();
        $comunidades=$user->comunidades()->get();
        
        if(isset($comunidades)){

            $data['comunidades'] = $comunidades;
            $data['instituciones'] = $instituciones;

            return view('alertas.nueva', $data);
        
        } else {

            return view('alertas.nueva');
        }
    
        
        
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
        $comunidad=Comunidad::find($request->comunidad);
        $alerta->comunidad()->associate($comunidad);
        $user_id=Auth::user()->id;
        $alerta->user_id = Auth::user()->id; //ACA HAY QUE PONER EL UID DEL USUARIO LOGEADO
        $alerta->estado = 0;
        $alerta->save();
        
        return redirect()->route('alerta.list');
    }

    public function store2(Request $request)
    {   

        $validation = $request->validate([
            
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'dni' => 'string|required',

            'lat' => 'numeric|nullable',
            'lng' => 'numeric|nullable',

            'fechaNacimiento' => 'date|nullable',

            'institucion_id' => 'integer|nullable',
            'comunidad_id' => 'integer|nullable',
        ]);


        $alerta = new Alerta($request->all());

        $alerta->user_id = Auth::user()->id;
        $alerta->estado = 0;

        if ($alerta->save()) {
            
            return response()->json([
                'status' => true,
                'msg' => $alerta->id,
            ]);

        } else {

            return response()->json([
                'status' => true,
                'msg' => 'Error al guardar los datos.',
            ]);
        }
        
    }

    public function misAlertas () {

        $data['personales'] = Alerta::where('user_id', '=', Auth::user()->id)->get();
                    
        return view('alertas.misAlertas', $data);
    }

    public function misActualizaciones ($offset = false) {

        if (!$offset)
            $offset = 0;
        
        $a1 = DB::table('alertas')
                ->select(DB::raw('"alertas" AS tipo, alertas.id, alertas.nombre, alertas.apellido, alertas.fechaNacimiento, alertas.dni, alertas.observaciones, alertas.created_at AS orden, instituciones.nombre AS posadero, alertas.asistido_id AS asistido'))
                ->leftJoin('instituciones', 'alertas.institucion_id', '=', 'instituciones.id')
                ->where('alertas.user_id', Auth::user()->id);

        $a2 = DB::table('alertas')
                ->select(DB::raw('"altas" AS tipo, alertas.id, alertas.nombre, alertas.apellido, alertas.fechaNacimiento, alertas.dni, alertas.observaciones, alertas.updated_at AS orden, instituciones.nombre AS posadero, alertas.asistido_id AS asistido'))
                ->leftJoin('instituciones', 'alertas.institucion_id', '=', 'instituciones.id')
                ->where('alertas.user_id', Auth::user()->id)
                ->whereNotNull('alertas.asistido_id');

        $alertas = $a1->union($a2)->orderBy('orden', 'DESC')->offset($offset)->limit(15)->get();

        return view('alertas.misActualizaciones')->with('alertas', $alertas)->with('offset', $offset);

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
       if(Auth::user()->tipoUsuario->slug == 'administrador' || Auth::user()->tipoUsuario->slug == 'posadero'){
            $data['alertas'] = Alerta::all()->where('estado','=',0);
            
       }else{
        $data['alertas'] = Alerta::all()->where('estado',0)->where('user_id',Auth::user()->id);
       }
        
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
    public function destroy($id)
    {
        $alerta=Alerta::find($id);
        $alerta->estado=2;
        $alerta->save();
        return redirect()->route('alerta.list');
    }
}
