<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comunidad;
use App\Institucion;
use App\Sexo;
use App\EstadoCivil;
use App\TipoNecesidad;
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

        $tiposNecesidades = TipoNecesidad::all();

        return view('reportes.busqueda')
        ->with('estadosCiviles', $estadosCiviles)
        ->with('sexos', $sexos)
        ->with('nacionalidades', $nacionalidades)
        ->with('tiposNecesidades', $tiposNecesidades)
        ->with('posaderos', $posaderos)
        ->with('comunidades', $comunidades);
    }

    public function search(Request $request)
    {

		$sql = "SELECT asistidos.id, asistidos.nombre, asistidos.apellido, asistidos.fechaNacimiento, TIMESTAMPDIFF(YEAR, asistidos.fechaNacimiento, CURDATE()) AS edad , asistidos.dni, sexos.descripcion AS descripcionSexo, estadosCiviles.descripcion AS descripcionEstadoCivil, asistidos.created_at, asistidos.institucion_id, fichasDatosPersonales.nacionalidad, fichasDatosPersonales.tienePartida, fichasDatosPersonales.celular, fichasDatosPersonales.telefono, fichasDatosPersonales.email, fichasDatosPersonales.nombreContacto, fichasDatosPersonales.telefonoContacto, fichasDatosPersonales.mailContacto, instituciones.nombre AS posadero";

		if ($request->filtroFicha == 'necesidades')
			$sql .= ", necesidades.especificacion AS necesidad, tiposNecesidades.descripcion AS necesidadTipo";

		if ($request->filtroFicha == 'necesidades')
			$sql .= ", fichasEmpleos.checklistTieneEmpleo";

		$sql .= " FROM asistidos 
				LEFT JOIN fichasDatosPersonales ON fichasDatosPersonales.asistido_id = asistidos.id
				LEFT JOIN sexos ON sexos.id = fichasDatosPersonales.sexo_id
				LEFT JOIN estadosCiviles ON estadosCiviles.id = fichasDatosPersonales.estadoCivil_id
				LEFT JOIN instituciones ON asistidos.institucion_id = instituciones.id";

		if ($request->filtroFicha != 'ninguna') {
			
	     	if ($request->filtroFicha == 'necesidades') {
	     		
	     		$sql.=' RIGHT JOIN fichasNecesidades ON fichasNecesidades.`asistido_id` = asistidos.id	
						INNER JOIN necesidades ON fichasNecesidades.id = necesidades.fichaNecesidad_id
						LEFT JOIN tiposNecesidades ON necesidades.tipoNecesidad_id = tiposNecesidades.id';	

				if (isset($request->tipoNecesidad) && $request->tipoNecesidad)
					$sql.= (" WHERE necesidades.tipoNecesidad_id = '".$request->tipoNecesidad."'");
				else 
					$sql.= " WHERE necesidades.id IS NOT NULL";
	     	}

	     	if ($request->filtroFicha == 'necesidades') {
	     		
	     		$sql.=' RIGHT JOIN fichasEmpleos ON fichasEmpleos.asistido_id = asistidos.id';	

				if (isset($request->empleo) && $request->empleo != '')
					$sql.= (" WHERE fichasEmpleos.checklistTieneEmpleo = '".$request->empleo."'");
				else 
					$sql.= " WHERE fichasEmpleos.id IS NOT NULL";
	     	}

		} else {
			
			$sql.=' WHERE asistidos.id IS NOT NULL';
		}

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
			$sql.=(" AND TIMESTAMPDIFF(YEAR, asistidos.fechaNacimiento, CURDATE()) BETWEEN '".$request->edadDesde."' AND '".$request->edadHasta."'");
		}

		if ($request->checkNacionalidad) {
			$sql.=(" AND fichasDatosPersonales.nacionalidad = '".$request->nacionalidad."'");
		}

		if ($request->checkPosadero) {
			$sql.=(" AND asistidos.institucion_id = '".$request->posadero."'");
		}

		if ($request->checkComunidad) {
			
			$temp="(SELECT asistido_id FROM asistido_comunidad WHERE";

			$comunidades = $request->input('comunidad');

			foreach ($comunidades as $key => $comunidad) {
				
				if ($key == 0)
					$temp.=(" asistido_comunidad.comunidad_id = '".$comunidad."'");
				else
					$temp.=(" OR asistido_comunidad.comunidad_id = '".$comunidad."'");
			}

			$temp.=")";

			$sql.=(" AND asistidos.id IN " . $temp);
		}

		if ($request->checkFechaAlta) {
			$sql.=(" AND asistidos.created_at BETWEEN '".$request->altaDesde."' AND '".$request->altaHasta."'");
		}

		$resultados = DB::select($sql);
		
		$view = view('reportes.resultados')
        ->with('resultados',$resultados)
        ->with('sql',$sql)
        ->render();

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);

    }

}
