<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Alerta;
use App\Asistido;
use App\User;
use App\Institucion;
use App\Consulta;
use App\Comunidad;

use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //Redireccionar a pagina de bienvenida
    }

    public function dashboard () {

        $one_week_ago = Carbon::now()->subWeeks(1);

        //Datos renglon superior
        $data['asistidos'] = Asistido::count();
        $data['asistidosNuevos'] = Asistido::where('created_at', '>', $one_week_ago->format('Y-m-d H:i:s'))->count();

        $data['consultas'] = Consulta::count();
        $data['consultasNuevas'] = Consulta::where('created_at', '>', $one_week_ago->format('Y-m-d H:i:s'))->count();

        $data['instituciones'] = Institucion::count();
        $data['institucionesNuevas'] = Institucion::where('created_at', '>', $one_week_ago->format('Y-m-d H:i:s'))->count();

        $data['comunidades'] = Institucion::count();
        $data['comunidadesNuevas'] = Institucion::where('created_at', '>', $one_week_ago->format('Y-m-d H:i:s'))->count();

        $data['usuarios'] = User::count();
        $data['usuariosNuevos'] = User::where('created_at', '>', $one_week_ago->format('Y-m-d H:i:s'))->count();

        //Alertas para el mapa
        $data['alertas'] = Alerta::all();
        $data['institucionesMapa'] = Institucion::where('direccion_id', '!=', NULL)->get();

        $data['alertasTotal'] = Alerta::count();
        $data['alertasPendientes'] = Alerta::where('asistido_id', '=', NULL)->count();
        $data['alertasPresentados'] = Alerta::where('asistido_id', '!=', NULL)->count();

        return view('dashboard', $data);
    }

    public function home () {

        $data['misComunidades'] = Auth::user()->comunidades()->get();
        $data['comunidades'] = Comunidad::all();

        return view('bienvenido', $data);
    }

    public function uca () {

        return view('uca');
    }
}
