<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::check() && (Auth::user()->tipoUsuario->slug=="administrador" || Auth::user()->tipoUsuario->descripcion=="posadero")){
        
            return $next($request);
            
        }else{
            return new Response(view('noAutorizado.noAutorizado'));
        }
    }
}
