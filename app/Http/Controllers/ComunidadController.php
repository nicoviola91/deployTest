<?php

namespace App\Http\Controllers;

use App\Comunidad;
use App\Institucion;
use App\Solicitud;
use App\User;
use App\MensajeComunidad;
use App\Consulta;
use Illuminate\Http\Request;
use App\Http\Requests\ComunidadRequest;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NuevaSolicitud;
use App\Notifications\AltaUsuarioComunidad;
use Image;
use Illuminate\Support\Facades\DB;

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
        if (Auth::user()->tipoUsuario->slug == 'administrador') {
            
            $data['instituciones'] = Institucion::all();
            $data['comunidades'] = Comunidad::all();
        
        } else {

            $data['comunidades'] = Auth::user()->institucion->comunidades;
        }
            
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

    public function storeMensaje(Request $request)
    {   
        $consulta = new MensajeComunidad([
            'mensaje' => $request->mensaje,
            'created_by' => Auth::user()->id,
        ]);

        $comunidad = Comunidad::find($request->id);
     
        $validation = $request->validate([
            'adjunto' => 'file|mimes:jpeg,png,jpg|max:20480'
        ]);

        if (null != $request->file('adjunto')) {
           
            // $path = $request->file('adjunto')->store();
            // $consulta->adjunto = $path;

            $image = $request->file('adjunto');
            $imageName = $image->getClientOriginalName();
            
            $fileName =  "mensaje_" . sha1(microtime()) . '.' . pathinfo($imageName, PATHINFO_EXTENSION);
            $thumbName = "thumb_" . $fileName;

            $directory = storage_path('app/public');
            $imageUrl = $directory.'/'.$fileName;
            Image::make($image)->save($imageUrl);

            $thumbUrl = $directory.'/'.$thumbName;
            Image::make($image)->fit(100, 100)->save($thumbUrl);

            $consulta->adjunto = $fileName;

        }
    
        if (isset($comunidad) && $comunidad->mensajes()->save($consulta)) {
            
            if (isset($path)) {
                return response()->json([
                    'status' => true,
                    'msg' => 'Consulta ingresada satisfactoriamente',
                    'adjunto' => $path, 
                    'texto' => $request->mensaje,
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'msg' => 'Consulta ingresada satisfactoriamente',
                    'texto' => $request->mensaje,
                ]);
            }
                
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Ocurrió un error al generar la consulta. Por favor vuelva a intentarlo.',
            ]);
        }

    }

    public function getActividadReciente ($id_comunidad, $offset = false) {

        if (!$offset)
            $offset = 0;

        //MENSAJES en el muro de la Comunidad
        $mensajes = DB::table('mensajesComunidad')
            ->select(DB::raw('"mensajes" AS type, mensajesComunidad.created_at, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, mensajesComunidad.mensaje AS content1, mensajesComunidad.adjunto AS content2, users.imagen AS content3, NULL AS content4, NULL AS content5'))
            ->leftJoin('users', 'mensajesComunidad.created_by', '=', 'users.id')
            ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
            ->where('mensajesComunidad.comunidad_id', $id_comunidad);
        
        $union = $mensajes;

        //ALERTAS compartidas por miembros de la Comunidad
        $alertas = DB::table('alertas')
            ->select(DB::raw('"alertas" AS type, alertas.created_at, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, alertas.nombre AS content1, alertas.apellido AS content2, alertas.observaciones AS content3, alertas.lat AS content4, alertas.lng AS content5'))
            ->leftJoin('users', 'alertas.user_id', '=', 'users.id')
            ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
            ->where('alertas.comunidad_id', $id_comunidad);            
        
        $union = $union->union($alertas);

        //MIEMBROS agregados a la Comunidad
        $miembros = DB::table('comunidad_user')
            ->select(DB::raw('"miembros" AS type, comunidad_user.created_at, NULL AS author1, NULL AS author2, NULL AS author3, users.name AS content1, users.apellido AS content2, users.email AS content3,NULL AS content4, NULL AS content5'))
            ->leftJoin('users', 'comunidad_user.user_id', '=', 'users.id')
            ->where('comunidad_user.comunidad_id', $id_comunidad);

        $union = $union->union($miembros);

        //ASISTIDOS asociados a la Comunidad
        $asistidos = DB::table('asistido_comunidad')
            ->select(DB::raw('"asistidos" AS type, asistido_comunidad.created_at, NULL AS author1, NULL AS author2, NULL AS author3, asistidos.nombre AS content1, asistidos.apellido AS content2, asistidos.dni AS content3, asistidos.id AS content4, NULL AS content5'))
            ->leftJoin('asistidos', 'asistido_comunidad.asistido_id', '=', 'asistidos.id')
            ->where('asistido_comunidad.comunidad_id', $id_comunidad);

        $union = $union->union($asistidos);

        //CONSULTAS referidas a ASISTIDOS asociados a la COMUNIDAD (a partir de que se asociaron: consultas.created_at > asistido_comunidad.created_at)
        //Solo si es profesional, coordinador, posadero o administrador

        if (Auth::user()->tipoUsuario->slug == 'posdaero' || Auth::user()->tipoUsuario->slug == 'profesional' || Auth::user()->tipoUsuario->slug == 'coordinador' || Auth::user()->tipoUsuario->slug == 'administrador') {
        
            $adiccion = DB::table('consultas')
                ->select(DB::raw('"consulta" AS type, consultas.created_at, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, asistidos.nombre AS content1, asistidos.apellido AS content2, consultas.mensaje AS content3, "Ficha Adiccion" AS content4, NULL AS content5'))
                ->leftJoin('fichasAdicciones', 'consultas.consultable_id', '=', 'fichasAdicciones.id')
                ->leftJoin('asistidos', 'fichasAdicciones.asistido_id', '=', 'asistidos.id')
                ->leftJoin('asistido_comunidad', 'asistidos.id', '=', 'asistido_comunidad.asistido_id')
                ->leftJoin('users', 'consultas.user_id', '=', 'users.id')
                ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
                ->where('asistido_comunidad.comunidad_id', $id_comunidad)
                ->where('consultas.consultable_type', 'LIKE', '%FichaAdiccion');

            $asistenciaSocial = DB::table('consultas')
                ->select(DB::raw('"consulta" AS type, consultas.created_at, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, asistidos.nombre AS content1, asistidos.apellido AS content2, consultas.mensaje AS content3, "Ficha Asistencia Social" AS content4, NULL AS content5'))
                ->leftJoin('fichasAsistenciasSociales', 'consultas.consultable_id', '=', 'fichasAsistenciasSociales.id')
                ->leftJoin('asistidos', 'fichasAsistenciasSociales.asistido_id', '=', 'asistidos.id')
                ->leftJoin('asistido_comunidad', 'asistidos.id', '=', 'asistido_comunidad.asistido_id')
                ->leftJoin('users', 'consultas.user_id', '=', 'users.id')
                ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
                ->where('asistido_comunidad.comunidad_id', $id_comunidad)
                ->where('consultas.consultable_type', 'LIKE', '%FichaAsistenciaSocial');

            $datosPersonales = DB::table('consultas')
                ->select(DB::raw('"consulta" AS type, consultas.created_at, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, asistidos.nombre AS content1, asistidos.apellido AS content2, consultas.mensaje AS content3, "Ficha Datos Personales" AS content4, NULL AS content5'))
                ->leftJoin('fichasDatosPersonales', 'consultas.consultable_id', '=', 'fichasDatosPersonales.id')
                ->leftJoin('asistidos', 'fichasDatosPersonales.asistido_id', '=', 'asistidos.id')
                ->leftJoin('asistido_comunidad', 'asistidos.id', '=', 'asistido_comunidad.asistido_id')
                ->leftJoin('users', 'consultas.user_id', '=', 'users.id')
                ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
                ->where('asistido_comunidad.comunidad_id', $id_comunidad)
                ->where('consultas.consultable_type', 'LIKE', '%FichaDatosPersonales');

            $diagnosticoIntegral = DB::table('consultas')
                ->select(DB::raw('"consulta" AS type, consultas.created_at, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, asistidos.nombre AS content1, asistidos.apellido AS content2, consultas.mensaje AS content3, "Ficha Diagnostico Integral" AS content4, NULL AS content5'))
                ->leftJoin('fichasDiagnosticosIntegrales', 'consultas.consultable_id', '=', 'fichasDiagnosticosIntegrales.id')
                ->leftJoin('asistidos', 'fichasDiagnosticosIntegrales.asistido_id', '=', 'asistidos.id')
                ->leftJoin('asistido_comunidad', 'asistidos.id', '=', 'asistido_comunidad.asistido_id')
                ->leftJoin('users', 'consultas.user_id', '=', 'users.id')
                ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
                ->where('asistido_comunidad.comunidad_id', $id_comunidad)
                ->where('consultas.consultable_type', 'LIKE', '%FichaDiagnosticoIntegral');

            $educacion = DB::table('consultas')
                ->select(DB::raw('"consulta" AS type, consultas.created_at, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, asistidos.nombre AS content1, asistidos.apellido AS content2, consultas.mensaje AS content3, "Ficha Educacion" AS content4, NULL AS content5'))
                ->leftJoin('fichasEducaciones', 'consultas.consultable_id', '=', 'fichasEducaciones.id')
                ->leftJoin('asistidos', 'fichasEducaciones.asistido_id', '=', 'asistidos.id')
                ->leftJoin('asistido_comunidad', 'asistidos.id', '=', 'asistido_comunidad.asistido_id')
                ->leftJoin('users', 'consultas.user_id', '=', 'users.id')
                ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
                ->where('asistido_comunidad.comunidad_id', $id_comunidad)
                ->where('consultas.consultable_type', 'LIKE', '%FichaEducacion');

            $empleos = DB::table('consultas')
                ->select(DB::raw('"consulta" AS type, consultas.created_at, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, asistidos.nombre AS content1, asistidos.apellido AS content2, consultas.mensaje AS content3, "Ficha Empleo" AS content4, NULL AS content5'))
                ->leftJoin('fichasEmpleos', 'consultas.consultable_id', '=', 'fichasEmpleos.id')
                ->leftJoin('asistidos', 'fichasEmpleos.asistido_id', '=', 'asistidos.id')
                ->leftJoin('asistido_comunidad', 'asistidos.id', '=', 'asistido_comunidad.asistido_id')
                ->leftJoin('users', 'consultas.user_id', '=', 'users.id')
                ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
                ->where('asistido_comunidad.comunidad_id', $id_comunidad)
                ->where('consultas.consultable_type', 'LIKE', '%FichaEmpleo');

            $familia = DB::table('consultas')
                ->select(DB::raw('"consulta" AS type, consultas.created_at, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, asistidos.nombre AS content1, asistidos.apellido AS content2, consultas.mensaje AS content3, "Ficha Familia y Amigos" AS content4, NULL AS content5'))
                ->leftJoin('fichasFamiliaAmigos', 'consultas.consultable_id', '=', 'fichasFamiliaAmigos.id')
                ->leftJoin('asistidos', 'fichasFamiliaAmigos.asistido_id', '=', 'asistidos.id')
                ->leftJoin('asistido_comunidad', 'asistidos.id', '=', 'asistido_comunidad.asistido_id')
                ->leftJoin('users', 'consultas.user_id', '=', 'users.id')
                ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
                ->where('asistido_comunidad.comunidad_id', $id_comunidad)
                ->where('consultas.consultable_type', 'LIKE', '%FichaFamiliaAmigos');

            $legal = DB::table('consultas')
                ->select(DB::raw('"consulta" AS type, consultas.created_at, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, asistidos.nombre AS content1, asistidos.apellido AS content2, consultas.mensaje AS content3, "Ficha Legal" AS content4, NULL AS content5'))
                ->leftJoin('fichasLegales', 'consultas.consultable_id', '=', 'fichasLegales.id')
                ->leftJoin('asistidos', 'fichasLegales.asistido_id', '=', 'asistidos.id')
                ->leftJoin('asistido_comunidad', 'asistidos.id', '=', 'asistido_comunidad.asistido_id')
                ->leftJoin('users', 'consultas.user_id', '=', 'users.id')
                ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
                ->where('asistido_comunidad.comunidad_id', $id_comunidad)
                ->where('consultas.consultable_type', 'LIKE', '%FichaLegal');

            $localizacion = DB::table('consultas')
                ->select(DB::raw('"consulta" AS type, consultas.created_at, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, asistidos.nombre AS content1, asistidos.apellido AS content2, consultas.mensaje AS content3, "Ficha Localizacion" AS content4, NULL AS content5'))
                ->leftJoin('fichasLocalizacion', 'consultas.consultable_id', '=', 'fichasLocalizacion.id')
                ->leftJoin('asistidos', 'fichasLocalizacion.asistido_id', '=', 'asistidos.id')
                ->leftJoin('asistido_comunidad', 'asistidos.id', '=', 'asistido_comunidad.asistido_id')
                ->leftJoin('users', 'consultas.user_id', '=', 'users.id')
                ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
                ->where('asistido_comunidad.comunidad_id', $id_comunidad)
                ->where('consultas.consultable_type', 'LIKE', '%FichaLocalizacion');

            $medica = DB::table('consultas')
                ->select(DB::raw('"consulta" AS type, consultas.created_at, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, asistidos.nombre AS content1, asistidos.apellido AS content2, consultas.mensaje AS content3, "Ficha Medica" AS content4, NULL AS content5'))
                ->leftJoin('fichasMedicas', 'consultas.consultable_id', '=', 'fichasMedicas.id')
                ->leftJoin('asistidos', 'fichasMedicas.asistido_id', '=', 'asistidos.id')
                ->leftJoin('asistido_comunidad', 'asistidos.id', '=', 'asistido_comunidad.asistido_id')
                ->leftJoin('users', 'consultas.user_id', '=', 'users.id')
                ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
                ->where('asistido_comunidad.comunidad_id', $id_comunidad)
                ->where('consultas.consultable_type', 'LIKE', '%FichaMedica');

            $necesidades = DB::table('consultas')
                ->select(DB::raw('"consulta" AS type, consultas.created_at, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, asistidos.nombre AS content1, asistidos.apellido AS content2, consultas.mensaje AS content3, "Ficha Necesidades" AS content4, NULL AS content5'))
                ->leftJoin('fichasNecesidades', 'consultas.consultable_id', '=', 'fichasNecesidades.id')
                ->leftJoin('asistidos', 'fichasNecesidades.asistido_id', '=', 'asistidos.id')
                ->leftJoin('asistido_comunidad', 'asistidos.id', '=', 'asistido_comunidad.asistido_id')
                ->leftJoin('users', 'consultas.user_id', '=', 'users.id')
                ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
                ->where('asistido_comunidad.comunidad_id', $id_comunidad)
                ->where('consultas.consultable_type', 'LIKE', '%FichaNecesidades');

            $saludMental = DB::table('consultas')
                ->select(DB::raw('"consulta" AS type, consultas.created_at, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, asistidos.nombre AS content1, asistidos.apellido AS content2, consultas.mensaje AS content3, "Ficha Salud Mental" AS content4, NULL AS content5'))
                ->leftJoin('fichasSaludMental', 'consultas.consultable_id', '=', 'fichasSaludMental.id')
                ->leftJoin('asistidos', 'fichasSaludMental.asistido_id', '=', 'asistidos.id')
                ->leftJoin('asistido_comunidad', 'asistidos.id', '=', 'asistido_comunidad.asistido_id')
                ->leftJoin('users', 'consultas.user_id', '=', 'users.id')
                ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
                ->where('asistido_comunidad.comunidad_id', $id_comunidad)
                ->where('consultas.consultable_type', 'LIKE', '%FichaSaludMental');

            $union = $union
                        ->union($adiccion)
                        ->union($asistenciaSocial)
                        ->union($datosPersonales)
                        ->union($diagnosticoIntegral)
                        ->union($educacion)
                        ->union($empleos)
                        ->union($familia)
                        ->union($legal)
                        ->union($localizacion)
                        ->union($medica)
                        ->union($necesidades)
                        ->union($saludMental);
        }


        //CREACION DE FICHAS referidas a ASISTIDOS asociados a la COMUNIDAD (a partir de que se asociaron: consultas.created_at > ficha.created_at)
        //Solo si es profesional, coordinador o posadero

        // $union = $mensajes
        //             ->union($alertas)
        //             ->union($asistidos)
        //             ->union($miembros)
        //             ->union($adiccion)
        //             ->union($asistenciaSocial)
        //             ->union($datosPersonales)
        //             ->union($diagnosticoIntegral)
        //             ->union($educacion)
        //             ->union($empleos)
        //             ->union($familia)
        //             ->union($legal)
        //             ->union($localizacion)
        //             ->union($medica)
        //             ->union($necesidades)
        //             ->union($saludMental)
        //             ->orderBy('created_at', 'desc')
        //             ->offset($offset)
        //             ->limit(8)
        //             ->get();


        $union = $union->orderBy('created_at', 'desc')->offset($offset)->limit(10)->get();
        return view('comunidades.actualizaciones')->with('actualizaciones', $union)->with('offset', $offset);

    }

}
