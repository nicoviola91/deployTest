<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class VerInstitucion
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
        //Administradores, Posaderos cuyo institucion coincide ID
        if ($request->user()->tipoUsuario->slug == 'administrador') {
            
            return $next($request);

        } else if ($request->user()->tipoUsuario->slug == 'posadero' && $request->route()->parameter('id') == $request->user()->institucion_id ) {

            return $next($request);
    
        } else {

            return new Response(view('errors.403'));
        }
    }
}
