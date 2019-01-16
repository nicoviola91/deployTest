<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class VerComunidad
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
        //Administradores, Posaderos cuyo institucion contiene a la comunidad ID, Coordinadores cuya comunidad_id coincide con ID, profesionales y samaritanos que pertenecen a la comunidad ID
        if ($request->user()->tipoUsuario->slug == 'administrador') {
            
            return $next($request);

        } else if ($request->user()->tipoUsuario->slug == 'posadero' && in_array($request->route()->parameter('id'), $request->user()->institucion->comunidades->pluck('id')->toArray())) {

            return $next($request);

        } else if ($request->user()->tipoUsuario->slug == 'coordinador' && $request->user()->comunidad_id == $request->route()->parameter('id')) {

            return $next($request);
        
        } else if (($request->user()->tipoUsuario->slug == 'profesional' || $request->user()->tipoUsuario->slug == 'samaritano') && in_array($request->route()->parameter('id'), $request->user()->comunidades->pluck('id')->toArray())) {

            return $next($request);
    
        } else {

            return new Response(view('errors.403'));
        }
    }
}
