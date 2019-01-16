<?php

namespace App\Http\Middleware;

use Closure;

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
        //administrador O posadero O profesional/samaritano que pertenece a una comunidad en comun con el asisitido O profesional/samaritano que lo tiene en favoritos?
        return $next($request);
    }
}
