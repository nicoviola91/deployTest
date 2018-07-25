<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class VerificarTipoDeUsuario
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
        if(auth()->check() && (auth()->user()->tipoUsuario->descripcion=="Administrador" || auth()->user()->tipoUsuario->descripcion=="Posadero" )){
            return $next($request);
        }else{
            return new Response(view('noAutorizado.noAutorizado'));
        }
        
    }
}
