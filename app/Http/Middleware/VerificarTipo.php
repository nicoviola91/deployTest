<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class VerificarTipo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    //Recibe una lista de tipos de usuarios (separados por coma) y verifica si el usuario autenticado coincide con alguno
    public function handle($request, Closure $next)
    {
        $tipos = array_slice(func_get_args(), 2);

        foreach ($tipos as $tipo) {
            
            if ($request->user()->tipoUsuario->slug == $tipo) {
               return $next($request); 
            }

        }

        return new Response(view('noAutorizado.noAutorizado'));
    }
}
