<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class VerificarUsuarioBuenSamaritano
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
        if(auth()->check() && (auth()->user()->tipoUsuario->descripcion=="Samaritano" || auth()->user()->tipoUsuario->descripcion=="Nuevo Usuario" )){
            return $next($request);
        }else{
            return new Response(view('noAutorizado.noAutorizado'));
        }
        
    }
}
