<?php

namespace App\Http\Middleware;

use Closure;

class VerificarTipo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    // public function handle($request, Closure $next, $tipo)
    // {
    //     if (!$request->user()->tipoUsuario->descripcion != $tipo) {

    //         return new Response(view('noAutorizado.noAutorizado'));
    //     }

    //     return $next($request);
    // }

    //Recibe una lista de tipos de usuarios (separados por coma) y verifica si el usuario autenticado coincide con alguno
    public function handle($request, Closure $next)
    {
        $tipos = array_slice(func_get_args(), 2);

        foreach ($tipos as $tipo) {
            
            if (Auth::->user()->tipoUsuario->descripcion == $tipo) {
               return $next($request); 
            }

        }

        return new Response(view('noAutorizado.noAutorizado'));
    }
}
