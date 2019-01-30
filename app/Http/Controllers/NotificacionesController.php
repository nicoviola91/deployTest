<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;

class NotificacionesController extends Controller
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

    public function updateReadNotif (Request $request) {

    	$user = Auth::user();

    	if (isset($request->timestamp))
    		$user->update(['readNotif' => $request->timestamp]);
    	else 
        	$user->update(['readNotif' => Carbon::now()]);
    }

    public function getNotificacionesSuperior ($offset = false) {

    	$resultados = $this->getNotificaciones(0, 0, true);
    	$unread = count($resultados);

    	$view = view('notificaciones.menuSuperior')
        ->with('resultados',$resultados)
        ->with('unread',$unread)
        ->render();

        return response()->json([
            'status' => true,
            'cantidad' => $unread,
            'hora' => Carbon::now()->format('Y/m/d H:i:s'),
            'view' => $view,
        ]);
    }

    public function getNotificacionesLateral ($offset = false) {

    	if (!$offset)
    		$offset = 0;

    	$cantidad = 13;

    	$resultados = $this->getNotificaciones($cantidad, $offset);

    	$view = view('notificaciones.menuLateral')
        ->with('resultados',$resultados)
        ->with('offset',$offset)
        ->render();

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);
    }

    public function unread () {

    	$resultados = count($this->getNotificaciones(0, 0, true));
    	
        return response()->json([
            'status' => true,
            'cantidad' => $resultados,
        ]);
    }

    private function getNotificaciones ($cantidad, $offset, $unread = false)
    {
        //PARA CUALQUIER TIPO DE USUARIO
        //ALTAS PROPIAS
        $altasPropias = DB::table('alertas')
                ->select(DB::raw('"altasPropias" AS type, alertas.updated_at AS orden, null AS author1, null AS author2, null AS author3, alertas.nombre AS content1, alertas.apellido AS content2, alertas.dni AS content3, instituciones.nombre AS content4, alertas.asistido_id AS content5'))
                ->leftJoin('instituciones', 'alertas.institucion_id', '=', 'instituciones.id')
                ->where('alertas.user_id', Auth::user()->id)
                ->whereNotNull('alertas.asistido_id');

        $sql = $altasPropias;

        //SOLCITUD ACEPTADA A UNA COMUNIDAD - link a la comunidad
    	$solicitudAceptada = DB::table('comunidad_user')
        ->select(DB::raw('"solicitudAceptada" AS type, comunidad_user.created_at AS orden, NULL AS author1, NULL AS author2, NULL AS author3, comunidades.nombre AS content1, null AS content2, null AS content3,NULL AS content4, comunidad_user.comunidad_id AS content5'))
        ->leftJoin('comunidades', 'comunidad_user.comunidad_id', '=', 'comunidades.id')
        ->where('comunidad_user.user_id', '=', Auth::user()->id);

        $sql = $sql->union($solicitudAceptada);

        //SI ES SAMARITANO O PROFESIONAL O COORDINADOR O POSADERO O ADMINISTRADOR
        if (Auth::user()->tipoUsuario->slug == 'samaritano' || Auth::user()->tipoUsuario->slug == 'profesional' || Auth::user()->tipoUsuario->slug == 'coordinador' || Auth::user()->tipoUsuario->slug == 'posadero' || Auth::user()->tipoUsuario->slug == 'administrador') {
        
	        //NUEVA ASOSIACION DE ASISTIDO A COMUNIDAD - link a la comunidad
	        $asistidos = DB::table('asistido_comunidad')
            ->select(DB::raw('"asistidos" AS type, asistido_comunidad.created_at AS orden, NULL AS author1, NULL AS author2, NULL AS author3, asistidos.nombre AS content1, asistidos.apellido AS content2, comunidades.nombre AS content3, asistidos.id AS content4, asistido_comunidad.comunidad_id AS content5'))
            ->leftJoin('asistidos', 'asistido_comunidad.asistido_id', '=', 'asistidos.id')
            ->leftJoin('comunidades', 'asistido_comunidad.comunidad_id', '=', 'comunidades.id')
            ->whereRaw('asistido_comunidad.comunidad_id IN (SELECT comunidad_user.comunidad_id FROM comunidad_user WHERE user_id = ?)', [Auth::user()->id]);

            $sql = $sql->union($asistidos);
    	    
    	    //NUEVA ALERTA DE LA COMUNIDAD SI NO FUE EL MISMO - link a la comunidad
        	$alertas = DB::table('alertas')
            ->select(DB::raw('"alertas" AS type, alertas.created_at AS orden, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, alertas.nombre AS content1, alertas.apellido AS content2, alertas.observaciones AS content3, comunidades.nombre AS content4, alertas.comunidad_id AS content5'))
            ->leftJoin('users', 'alertas.user_id', '=', 'users.id')
            ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
			->leftJoin('comunidades', 'alertas.comunidad_id', '=', 'comunidades.id')            
            ->where('alertas.user_id', '<>', Auth::user()->id)
            ->whereRaw('alertas.comunidad_id IN (SELECT comunidad_user.comunidad_id FROM comunidad_user WHERE user_id = ?)', [Auth::user()->id]);

            $sql = $sql->union($alertas);

        	//NUEVO MENSAJE DE LA COMUNIDAD SI NO FUE EL MISMO - link a la comunidad
        	$mensajes = DB::table('mensajesComunidad')
            ->select(DB::raw('"mensajes" AS type, mensajesComunidad.created_at AS orden, users.name AS author1, users.apellido AS author2, tiposUsuarios.nombre AS author3, mensajesComunidad.mensaje AS content1, mensajesComunidad.adjunto AS content2, users.imagen AS content3, comunidades.nombre AS content4, mensajesComunidad.comunidad_id AS content5'))
            ->leftJoin('users', 'mensajesComunidad.created_by', '=', 'users.id')
            ->leftJoin('tiposUsuarios', 'users.tipoUsuario_id', '=', 'tiposUsuarios.id')
            ->leftJoin('comunidades', 'mensajesComunidad.comunidad_id', '=', 'comunidades.id')
            ->where('mensajesComunidad.created_by', '<>', Auth::user()->id)
            ->whereRaw('mensajesComunidad.comunidad_id IN (SELECT comunidad_user.comunidad_id FROM comunidad_user WHERE user_id = ?)', [Auth::user()->id]);

        	$sql = $sql->union($mensajes);

        	//NUEVO MIEMBRO EN LA COMUNIDAD SI NO FUE EL MISMO - link a la comunidad
        	$miembros = DB::table('comunidad_user')
            ->select(DB::raw('"miembros" AS type, comunidad_user.created_at AS orden, NULL AS author1, NULL AS author2, NULL AS author3, users.name AS content1, users.apellido AS content2, users.email AS content3,NULL AS content4, comunidad_user.comunidad_id AS content5'))
            ->leftJoin('users', 'comunidad_user.user_id', '=', 'users.id')
            ->where('comunidad_user.user_id', '<>', Auth::user()->id)
            ->whereRaw('comunidad_user.comunidad_id IN (SELECT comunidad_user.comunidad_id FROM comunidad_user WHERE user_id = ?)', [Auth::user()->id]);

            $sql = $sql->union($miembros);

        }

        //SI ES COORDINADOR O POSADERO
            //NUEVAS SOLICITUDES EN SUS COMUNIDADES (coordinador segun comunidad id, posadero segun todas sus comunidades) - link a la comunidad
        
		//SI ES COORDINADOR O PROFESIONAL O POSADERO O ADMINISTRADOR
        	//NUEVA CONSULTA PARA UN ASISTIDO DE LA COMUNDIAD SI NO FUE EL - link al asistido
            //NUEVA FICHA PARA UN ASISTIDO DE LA COMUNIDAD SI NO FUE EL - link al asistido        
        
        //PENDIENTES:
            //NUEVA DONACION EN TU POSADERO?
        	//NUEVA NECESIDAD EN LA COMUNIDAD SI NO FUE EL MISMO?

        if ($unread) {
        	
        	$resultados = DB::table(DB::raw('('.$sql->toSql().') as t1'))
			    ->select('*')
			    ->orderBy('orden', 'desc')
			    //->where('orden', '>', Auth::user()->readNotif)
			    ->whereRaw("orden > '" . Auth::user()->readNotif . "'")
			    ->mergeBindings($sql)
			    ->get();

        } else {
        	
        	$resultados = DB::table(DB::raw('('.$sql->toSql().') as t1'))
			    ->select('*')
			    //->where('orden', '>', Auth::user()->created_at)
			    ->whereRaw("orden > '" . Auth::user()->created_at . "'")
			    ->orderBy('orden', 'desc')
			    ->offset($offset)
			    ->limit($cantidad)
			    ->mergeBindings($sql)
			    ->get();
        
        }

        return $resultados;
    }

    

}
