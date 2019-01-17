<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Asistido;
use App\User;

class FavoritosController extends Controller
{
    public function __construct() {

		$this->middleware('auth');
	}


	public function store ($asistido_id) {
	
		$user = Auth::user();

		if (is_numeric($asistido_id)) {
			
			$asistido = Asistido::find($asistido_id);

			if (isset($asistido)) {
				
				$user->favoritos()->attach($asistido_id);
				return response()->json(['status' => true]);
				
			} else {
				return response()->json(['status' => false, 'msg' => 'Error de validacion.']);
			}
		} else {

			return response()->json(['status' => false, 'msg' => 'Error de validacion.']);
		}
			
	}

	public function destroy ($asistido_id) {
		
		$user = Auth::user();

		if (is_numeric($asistido_id)) {
			
			$asistido = Asistido::find($asistido_id);

			if (isset($asistido)) {
				
				if ($user->favoritos()->detach($asistido_id)) {
					return response()->json(['status' => true]);
				} else {
					return response()->json(['status' => false, 'msg' => 'Ocurrio un error al procesar la solicitud.']);
				} 
			} else {
				return response()->json(['status' => false, 'msg' => 'Error de validacion.']);
			}
		} else {

			return response()->json(['status' => false, 'msg' => 'Error de validacion.']);
		}

	}
		


}
