<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistido;
use App\FichaLegal;
use App\Antecedente;
use App\RamaDerecho;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FichaLegalController extends Controller
{
    public function __construct () {

        $this->middleware('auth');

    }
    
    public function create($asistido_id){
        $asistido=Asistido::find($asistido_id);
        //para poder mostrar las ramas del derecho cuando se agrega un antecedente
        $ramasDerecho=RamaDerecho::all(['id','descripcion']);

        $fichaLegal=$this->findFichaLegalByAsistidoId($asistido_id);
        if(isset($fichaLegal)){
            $antecedentes=Antecedente::where('fichaLegal_id',$fichaLegal->id)->get();
            return view('altaFichas.fichaLegal')
                ->with('asistido',$asistido)
                ->with('ramasDerecho',$ramasDerecho)
                ->with('antecedentes',$antecedentes);
        }
        return view('altaFichas.fichaLegal')->with('asistido',$asistido)->with('ramasDerecho',$ramasDerecho);
    }

    public function get ($asistido_id) {

        $asistido=Asistido::find($asistido_id);
        $ramasDerecho=RamaDerecho::all(['id','descripcion']);

        $fichaLegal=$this->findFichaLegalByAsistidoId($asistido_id);
        
        if(isset($fichaLegal)){
        
            $antecedentes=Antecedente::where('fichaLegal_id',$fichaLegal->id)->get();
        
            $view = view('altaFichas.fichaLegal2')
                ->with('asistido',$asistido)
                ->with('ramasDerecho',$ramasDerecho)
                ->with('antecedentes',$antecedentes)
                ->render();
        }

        $view = view('altaFichas.fichaLegal2')->with('asistido',$asistido)->with('ramasDerecho',$ramasDerecho)->render();

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);
    }

    public function storeAntecedente(Request $request, $asistido_id){

        $antecedente=new Antecedente($request->all());
        Asistido::where('id',$asistido_id)->update(['checkFichaLegal' =>1]);
        $fichaLegal=$this->findFichaLegalByAsistidoId($asistido_id);
        FichaLegal::where('asistido_id',$asistido_id)
        ->update(['chk_antecedentesPenales'=>1]);
        $fichaLegal->antecedentes()->save($antecedente);
        $antecedente->save();

        return redirect()->route('fichaLegal.create',['asistido_id'=>$asistido_id]); 

    }

    
    public function destroyAntecedente(Request $request){
        $antecedente_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $antecedente=Antecedente::find($antecedente_id);
        $antecedente->delete();
        return redirect()->route('fichaLegal.create',['asistido_id'=>$asistido_id]);
    }



    public function findFichaLegalByAsistidoId($asistido_id){
        $fichaLegal=FichaLegal::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(!isset($fichaLegal)){
            $fichaLegal=new FichaLegal();
            $fichaLegal->createdBy=Auth::user()->id;
            $asistido->ficha()->save($fichaLegal);
            $fichaLegal->checkFichaLegal=1;
            $fichaLegal->save();
        }
        return $fichaLegal;
    }

}
