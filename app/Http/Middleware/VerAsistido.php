<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerAsistido
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        //Administrador O Posadero O Profesional/Samaritano/Coordinador que pertenece a una comunidad en comun con el asisitido O Profesional/Samaritano/Coordinador que lo tiene en favoritos?
        if ($request->user()->tipoUsuario->slug == 'administrador') {
            
            return $next($request);

        } else if ($request->user()->tipoUsuario->slug == 'posadero' ) {

            return $next($request);

        } else if (($request->user()->tipoUsuario->slug == 'profesional' || $request->user()->tipoUsuario->slug == 'coordinador' || $request->user()->tipoUsuario->slug == 'samaritano')) {

            $resultado = DB::table('comunidad_user')
                ->select(DB::raw('asistido_comunidad.asistido_id'))
                ->leftJoin('asistido_comunidad', 'comunidad_user.comunidad_id', '=', 'asistido_comunidad.comunidad_id')
                ->where('comunidad_user.user_id', $request->user()->id)
                ->where('asistido_comunidad.asistido_id', $request->route()->parameter('id'))->distinct()->get();

            if ($resultado->count() > 0)
                return $next($request);
            else
                return new Response(view('errors.403'));   
    
        } else {

            return new Response(view('errors.403'));
        }
    }
}
