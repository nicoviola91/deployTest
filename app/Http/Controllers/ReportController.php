<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comunidad;
use App\Institucion;
use App\Sexo;
use App\EstadoCivil;
use App\TipoNecesidad;
use App\TipoEducacion;
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
        $tiposEducaciones = TipoEducacion::all();
        $orientaciones = DB::select("SELECT DISTINCT educaciones.orientacion FROM educaciones WHERE (educaciones.orientacion IS NOT NULL) AND (educaciones.orientacion <> '')");

        return view('reportes.busqueda')
        ->with('estadosCiviles', $estadosCiviles)
        ->with('sexos', $sexos)
        ->with('nacionalidades', $nacionalidades)
        ->with('tiposNecesidades', $tiposNecesidades)
        ->with('tiposEducaciones', $tiposEducaciones)
        ->with('orientaciones', $orientaciones)
        ->with('posaderos', $posaderos)
        ->with('comunidades', $comunidades);
    }

    public function searchAnterior(Request $request)
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

    public function search(Request $request)
    {

    	if ($request->filtroFicha == 'ninguna') {
    		
			$sql = "
			SELECT asistidos.id, asistidos.nombre, asistidos.apellido, asistidos.fechaNacimiento, TIMESTAMPDIFF(YEAR, asistidos.fechaNacimiento, CURDATE()) AS edad , asistidos.dni, sexos.descripcion AS descripcionSexo, estadosCiviles.descripcion AS descripcionEstadoCivil, asistidos.created_at, asistidos.institucion_id, fichasDatosPersonales.nacionalidad, fichasDatosPersonales.tienePartida, fichasDatosPersonales.celular, fichasDatosPersonales.telefono, fichasDatosPersonales.email, fichasDatosPersonales.nombreContacto, fichasDatosPersonales.telefonoContacto, fichasDatosPersonales.mailContacto, instituciones.nombre AS posadero
			FROM asistidos 
			LEFT JOIN fichasDatosPersonales ON fichasDatosPersonales.asistido_id = asistidos.id
			LEFT JOIN sexos ON sexos.id = fichasDatosPersonales.sexo_id
			LEFT JOIN estadosCiviles ON estadosCiviles.id = fichasDatosPersonales.estadoCivil_id
			LEFT JOIN instituciones ON asistidos.institucion_id = instituciones.id
			WHERE asistidos.id IS NOT NULL
			";
		}
		else if ($request->filtroFicha == 'necesidades') {

			$sql = "
			SELECT asistidos.id, asistidos.nombre, asistidos.apellido, asistidos.fechaNacimiento, TIMESTAMPDIFF(YEAR, asistidos.fechaNacimiento, CURDATE()) AS edad , asistidos.dni, sexos.descripcion AS descripcionSexo, estadosCiviles.descripcion AS descripcionEstadoCivil, asistidos.created_at, asistidos.institucion_id, fichasDatosPersonales.nacionalidad, fichasDatosPersonales.tienePartida, fichasDatosPersonales.celular, fichasDatosPersonales.telefono, fichasDatosPersonales.email, fichasDatosPersonales.nombreContacto, fichasDatosPersonales.telefonoContacto, fichasDatosPersonales.mailContacto, instituciones.nombre AS posadero,
				necesidades.id AS necesidad_id, necesidades.created_at AS necesidad_created_at, necesidades.updated_at AS necesidad_updated_at, necesidades.especificacion AS necesidadDescripcion, necesidades.fechaInicio AS necesidadFechaInicio, necesidades.fechaFin AS necesidadFechaFin, necesidades.donacion_id,
				tiposNecesidades.descripcion AS tipoNecesidad,
				users.name AS creatorNombre, users.apellido AS creatorApellido, users.email AS creatorEmail, tiposUsuarios.nombre AS creatorTipoUsuario
			FROM necesidades
			LEFT JOIN tiposNecesidades ON necesidades.tipoNecesidad_id = tiposNecesidades.id
			LEFT JOIN users ON necesidades.created_by = users.id
			LEFT JOIN tiposUsuarios ON users.tipoUsuario_id = tiposUsuarios.id
			LEFT JOIN fichasNecesidades ON necesidades.fichaNecesidad_id = fichasNecesidades.id
			LEFT JOIN asistidos ON fichasNecesidades.asistido_id = asistidos.id
			
			LEFT JOIN instituciones ON asistidos.institucion_id = instituciones.id
			LEFT JOIN fichasDatosPersonales ON fichasDatosPersonales.asistido_id = asistidos.id
			LEFT JOIN sexos ON sexos.id = fichasDatosPersonales.sexo_id
			LEFT JOIN estadosCiviles ON estadosCiviles.id = fichasDatosPersonales.estadoCivil_id
			WHERE asistidos.id IS NOT NULL
			";

			if ($request->tipoNecesidad) {
				$sql.=(" AND necesidades.tipoNecesidad_id = '".$request->tipoNecesidad."'");
			}

			if ($request->donacion) {

				if ($request->donacion == '1') {
					$sql.=(" AND necesidades.donacion_id IS NOT NULL");
				}

				if ($request->donacion == '2') {
					$sql.=(" AND necesidades.donacion_id IS NULL");
				}

			}
		}
		else if ($request->filtroFicha == 'empleo') {

			$sql = "
			SELECT asistidos.id, asistidos.nombre, asistidos.apellido, asistidos.fechaNacimiento, TIMESTAMPDIFF(YEAR, asistidos.fechaNacimiento, CURDATE()) AS edad , asistidos.dni, sexos.descripcion AS descripcionSexo, estadosCiviles.descripcion AS descripcionEstadoCivil, asistidos.created_at, asistidos.institucion_id, fichasDatosPersonales.nacionalidad, fichasDatosPersonales.tienePartida, fichasDatosPersonales.celular, fichasDatosPersonales.telefono, fichasDatosPersonales.email, fichasDatosPersonales.nombreContacto, fichasDatosPersonales.telefonoContacto, fichasDatosPersonales.mailContacto, instituciones.nombre AS posadero,
				fichasEmpleos.checklistTieneEmpleo AS tieneEmpleo
			FROM fichasEmpleos
			LEFT JOIN asistidos ON fichasEmpleos.asistido_id = asistidos.id
			
			LEFT JOIN instituciones ON asistidos.institucion_id = instituciones.id
			LEFT JOIN fichasDatosPersonales ON fichasDatosPersonales.asistido_id = asistidos.id
			LEFT JOIN sexos ON sexos.id = fichasDatosPersonales.sexo_id
			LEFT JOIN estadosCiviles ON estadosCiviles.id = fichasDatosPersonales.estadoCivil_id
			WHERE asistidos.id IS NOT NULL
			";

			if ($request->empleo) {

				if ($request->empleo == '1') {
					$sql.=(" AND fichasEmpleos.checklistTieneEmpleo = '1'");
				}

				if ($request->empleo == '2') {
					$sql.=(" AND fichasEmpleos.checklistTieneEmpleo = '0'");
				}
			}
		}
		else if ($request->filtroFicha == 'educacion') {

			$sql = "
			SELECT asistidos.id, asistidos.nombre, asistidos.apellido, asistidos.fechaNacimiento, TIMESTAMPDIFF(YEAR, asistidos.fechaNacimiento, CURDATE()) AS edad , asistidos.dni, sexos.descripcion AS descripcionSexo, estadosCiviles.descripcion AS descripcionEstadoCivil, asistidos.created_at, asistidos.institucion_id, fichasDatosPersonales.nacionalidad, fichasDatosPersonales.tienePartida, fichasDatosPersonales.celular, fichasDatosPersonales.telefono, fichasDatosPersonales.email, fichasDatosPersonales.nombreContacto, fichasDatosPersonales.telefonoContacto, fichasDatosPersonales.mailContacto, instituciones.nombre AS posadero,
				educaciones.institucion AS institucionEduc, educaciones.nivelAlcanzado AS nivelEduc, educaciones.orientacion AS orientacionEduc, educaciones.tituloObtenido AS tituloEduc, tiposEducaciones.descripcion AS tipoEduc
			FROM educaciones
			LEFT JOIN tiposEducaciones ON educaciones.tipoEducacion_id = tiposEducaciones.id
			LEFT JOIN fichasEducaciones ON educaciones.ficha_educacion_id = fichasEducaciones.id
			LEFT JOIN asistidos ON fichasEducaciones.asistido_id = asistidos.id
			
			LEFT JOIN instituciones ON asistidos.institucion_id = instituciones.id
			LEFT JOIN fichasDatosPersonales ON fichasDatosPersonales.asistido_id = asistidos.id
			LEFT JOIN sexos ON sexos.id = fichasDatosPersonales.sexo_id
			LEFT JOIN estadosCiviles ON estadosCiviles.id = fichasDatosPersonales.estadoCivil_id
			WHERE asistidos.id IS NOT NULL
			";

			if ($request->tipoEducacion) {
				$sql.=(" AND educaciones.tipoEducacion_id = '".$request->tipoEducacion."'");
			}

			if ($request->nivelAlcanzado) {
				$sql.=(" AND educaciones.nivelAlcanzado = '".$request->nivelAlcanzado."'");
			}

			if ($request->orientacion) {
				$sql.=(" AND educaciones.orientacion = '".$request->orientacion."'");
			}
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
        ->with('tipo',$request->filtroFicha)
        ->with('sql',$sql)
        ->render();

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);

    }

}
