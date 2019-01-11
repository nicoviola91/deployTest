<?php

namespace App\Http\Controllers;

use App\Comunidad;
use App\Institucion;
use App\Solicitud;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ComunidadRequest;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NuevaSolicitud;
use App\Notifications\AltaUsuarioComunidad;

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

    public function showMuro($id)
    {   
        $data['comunidad'] = Comunidad::find($id);
        return view('comunidades.muro', $data);
    }

    public function update (Request $request) {

        $comunidad = Comunidad::where('id',$request->id)->first();

        $comunidad->nombre = $request->nombre;
        $comunidad->observaciones = $request->observaciones;
        $comunidad->tipo = $request->tipo;
        $comunidad->institucion_id = $request->institucion_id;

        $comunidad->save();
        
        return redirect()->back();
    }

    public function enviarSolicitud (Request $request) {

        $comunidad = $request->comunidad_id;

        if (is_numeric($comunidad)) {

            $misComunidades = Auth::user()->comunidades()->get();
            $misSolicitudes = Solicitud::where('user_id', Auth::user()->id)->get();

            //Si ya existe en la comunidad
            if ($misComunidades->contains('id', $comunidad)) {
                
                return response()->json([
                    'status' => false,
                    'msg' => 'Ya sos miembro de esa Comunidad.'
                ]);
            
            } 
            //Si ya existe en la lista de solicitudes
            else if ($misSolicitudes->contains('comunidad_id', $comunidad)) {

                return response()->json([
                    'status' => false,
                    'msg' => 'Ya existe una solicitud pendiente para esa Comunidad.'
                ]);

            } else {

                //Crear Solicitud
                $solicitud = new Solicitud();

                $solicitud->user_id = Auth::user()->id;
                $solicitud->comunidad_id = $comunidad;
                $solicitud->estado = 0;

                if ($solicitud->save()) {
                    //Aca va la notificacion al encargado de aprobar la solicitud
                    $comunidad_2 = Comunidad::where('id',$request->comunidad_id)->first();
                    $responsable = User::where('id',$comunidad_2->coordinador_id)->first();
                    if (isset($responsable)){
                        $responsable->notify(new NuevaSolicitud($solicitud, $comunidad_2));
                    }
                    return response()->json([
                        'status' => true,
                        'msg' => 'Solicitud enviada satisfactoriamente.'

                    ]);
                    
                } else {
                    return response()->json([
                        'status' => false,
                        'msg' => 'Ocurrió un error inesperado.'
                    ]);
                }
            }

        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Datos no válidos.'
            ]);
        }
    }

    public function descartarSolicitud (Request $request) {

        $solicitud = $request->solicitud_id;

        if (is_numeric($solicitud)) {
            
            if (Solicitud::destroy($solicitud)) {
                
                return response()->json([
                    'status' => true,
                    'msg' => 'Solicitud descartada.'
                ]);
            
            } else {
                
                return response()->json([
                    'status' => false,
                    'msg' => 'Ocurrió un error inesperado.'
                ]);
            }

        } else {

            return response()->json([
                'status' => false,
                'msg' => 'Datos no válidos.'
            ]);
        }
    }

    public function aprobarSolicitud (Request $request) {

        $solicitud = $request->solicitud_id;

        if (is_numeric($solicitud)) {
            
            $solicitud = Solicitud::where('id', $solicitud)->first();

            if (isset($solicitud)) {
                
                $user = User::find($solicitud->user_id);
                $comunidad_id = $solicitud->comunidad_id;

                if (!$user->comunidades()->where('comunidad_id', $comunidad_id)->exists()) {
                    
                    $user->comunidades()->attach($comunidad_id);
                    /* Notifiacion de Nuevo usuario agregado a la comunidad*/
                    $comun_notif = Comunidad::where('id',$comunidad_id)->first();
                    if(isset($comun_notif->users) && count($comun_notif->users) > 0){
                        foreach ($comun_notif->users as $comunitario) {
                            $comunitario->notify(new AltaUsuarioComunidad($user));    
                        }    
                    }
                    Solicitud::destroy($solicitud->id);

                    return response()->json([
                        'status' => true,
                        'msg' => 'Solicitud aprobada satisfactoriamente.'
                    ]);

                }

            } else {

                return response()->json([
                    'status' => false,
                    'msg' => 'Solicitud inexistente.'
                ]);
            }

        } else {

            return response()->json([
                'status' => false,
                'msg' => 'Datos no válidos.'
            ]);
        }
    }

}
