<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comunidad;
use App\Institucion;
use App\Sexo;
use App\EstadoCivil;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    
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
     *
     * @return \Illuminate\Http\Response
     */
    public function showSearch()
    {
        $comunidades = Comunidad::all();
        $posaderos=Institucion::where('tipo', '=', 'posadero')->get();
        
        $sexos= Sexo::all();
        $estadosCiviles = EstadoCivil::all();
        $nacionalidades = DB::select("SELECT DISTINCT fichasDatosPersonales.nacionalidad FROM fichasDatosPersonales WHERE (fichasDatosPersonales.nacionalidad IS NOT NULL) AND (fichasDatosPersonales.nacionalidad <> '')");

        return view('reportes.busqueda')
        ->with('estadosCiviles', $estadosCiviles)
        ->with('sexos', $sexos)
        ->with('nacionalidades', $nacionalidades)
        ->with('posaderos', $posaderos)
        ->with('comunidades', $comunidades);
    }

    public function search(Request $request)
    {

    	$sql = "SELECT asistidos.id, asistidos.nombre, asistidos.apellido, asistidos.fechaNacimiento, TIMESTAMPDIFF(YEAR, asistidos.fechaNacimiento, CURDATE()) AS edad , asistidos.dni, sexos.descripcion AS descripcionSexo, estadosCiviles.descripcion AS descripcionEstadoCivil, asistidos.created_at, asistidos.institucion_id, fichasDatosPersonales.nacionalidad, fichasDatosPersonales.tienePartida, fichasDatosPersonales.celular, fichasDatosPersonales.telefono, fichasDatosPersonales.email, fichasDatosPersonales.nombreContacto, fichasDatosPersonales.telefonoContacto, fichasDatosPersonales.mailContacto
				FROM asistidos 
				LEFT JOIN fichasDatosPersonales ON fichasDatosPersonales.asistido_id = asistidos.id
				LEFT JOIN sexos ON sexos.id = fichasDatosPersonales.sexo_id
				LEFT JOIN estadosCiviles ON estadosCiviles.id = fichasDatosPersonales.estadoCivil_id		
		";

    	if ($request->filtroFicha == 'ninguna') {

    		$sql.=' WHERE asistidos.id IS NOT NULL';

			if ($request->checkNombre) {
				$sql.=(" AND asistidos.nombre LIKE '%".$request->nombre."%'");
			}

			if ($request->checkApellido) {
				$sql.=(" AND asistidos.apellido LIKE '%".$request->apellido."%'");
			}

			if ($request->checkSexo && $request->sexo) {
				$sql.=(" AND sexos.id = '".$request->sexo."'");
			}

			if ($request->checkEstadoCivil && $request->estadoCivil) {
				$sql.=(" AND estadosCiviles.id = '".$request->estadoCivil."'");
			}

			if ($request->checkEdad) {
				$sql.=(" AND edad BETWEEN '".$request->edadDesde."' AND '".$request->edadHasta."'");
			}

			if ($request->checkNacionalidad) {
				$sql.=(" AND fichasDatosPersonales.nacionalidad = '".$request->nacionalidad."'");
			}

			if ($request->checkPosadero) {
				$sql.=(" AND asistidos.institucion_id = '".$request->posadero."'");
			}

			if ($request->checkFechaAlta) {
				$sql.=(" AND asistidos.created_at BETWEEN '".$request->altaDesde."' AND '".$request->altaHasta."'");
			}

			$resultados = DB::select($sql);

			$view = view('reportes.resultados')
            ->with('resultados',$resultados)
            ->render();

            return response()->json([
	            'status' => true,
	            'view' => $view,
	        ]);

    	}
	     	
    }

}
