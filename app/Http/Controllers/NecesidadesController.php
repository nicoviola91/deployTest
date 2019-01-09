<?php

namespace App\Http\Controllers;

use App\Necesidad;
use App\Donacion;
use App\FichaNecesidad;
use Illuminate\Http\Request;

class NecesidadesController extends Controller
{   
    public function __construct () {

        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Display the specified resource list.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $data['necesidades'] = necesidad::all();
        return view('necesidades.listado', $data);
    }

    public function public_list()
    {
        $data['necesidades'] = necesidad::all();
        return view('necesidades.listado', $data);
    }

    public function nueva_donacion(Request $request)
    {
        $donac = new Donacion();
        $donac->nombre=$request->nombre;
        $donac->apellido=$request->apellido;
        $donac->tel_contacto=$request->tel_contacto;
        $donac->mail_contacto=$request->mail_contacto;
        $donac->mensaje=$request->mensaje;
        $donac->necesidad_id = $request->necesidad_id;
        $donac->save();
        //Notifico al dueño de la ficha que hay una donación para una necesidad de su ficha
        $necesidad = Necesidad::where('id',$donac->necesidad_id);
        $ficha_necesidad=FichaNecesidad::where('id',$necesidad->fichaNecesidad_id);
        $usr_notificacion = User::where('id',$ficha_necesidad->created_by);
        $usr_notificacion->notify(new altaNuevaDonacion($donac, $necesidad));
        //Fin Notificacion
        $data['necesidades'] = Necesidad::all();
        return view('necesidades.listado', $data);
    }


}
