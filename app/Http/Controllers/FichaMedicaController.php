<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Javascript; para poder levantar las las enfermedades dependiendo de la afeccion en la view
use App\FichaMedica;
use App\Tratamiento;
use App\Institucion;
use App\ConsultaMedica;
use App\Medicacion;
use App\Asistido;
use App\Profesional;
use App\Intervencion;
use App\Enfermedad;
use App\Afeccion;
use App\Sintoma;
use Illuminate\Support\Facades\Auth;




class FichaMedicaController extends Controller
{
    public function __construct () {

        $this->middleware('auth');

    }
    
    public function create($asistido_id){
        $asistido=Asistido::find($asistido_id);
        $fichaMedica=$this->findFichaMedicaByAsistidoId($asistido_id);
        $sintomasGenericos=Sintoma::all();
        $enfermedadesGenericas=Enfermedad::all();
        $afecciones=Afeccion::all();
        
        if(isset($fichaMedica)){
            //para traer de la relacion many to many los relacionados con esta ficha medica
            $sintomasDelAsistido=FichaMedica::find($fichaMedica->id)->sintomas;
            $consultasMedicas=ConsultaMedica::where('fichaMedica_id',$fichaMedica->id)->get();
            $profesionales=$fichaMedica->profesional()->get(); 
            $enfermedadesDelAsistido=$fichaMedica->enfermedades->all();
            $tratamientos=Tratamiento::where('fichaMedica_id',$fichaMedica->id)->get();
            $medicaciones=Medicacion::where('fichaMedica_id',$fichaMedica->id)->get();
            $intervenciones=Intervencion::where('fichaMedica_id',$fichaMedica->id)->get();
            $afeccionesGenericas=Afeccion::all();
            
            
            return view('altaFichas.fichaMedica')
                ->with('asistido',$asistido)
                ->with('sintomasGenericos',$sintomasGenericos)
                ->with('sintomasDelAsistido',$sintomasDelAsistido)
                ->with('profesionales',$profesionales)
                ->with('fichaMedica',$fichaMedica)
                ->with('medicaciones',$medicaciones)
                ->with('tratamientos',$tratamientos)
                ->with('intervenciones',$intervenciones)
                ->with('consultasMedicas',$consultasMedicas)
                ->with('enfermedadesGenericas',$enfermedadesGenericas)
                ->with('enfermedadesDelAsistido',$enfermedadesDelAsistido)
                ->with('afecciones',$afecciones);
        }
        return view('altaFichas.fichaMedica')->with('asistido',$asistido)->with('enfermedadesGenericas',$enfermedadesGenericas)->with('sintomasGenericos',$sintomasGenericos)->with('afecciones',$afecciones);
    }

    public function get($asistido_id){

        $asistido=Asistido::find($asistido_id);

        $fichaMedica=$this->findFichaMedicaByAsistidoId($asistido_id);
        
        //En este metodo, traer las colecciones de tratamientos, episodios y adicciones, si existe la ficha
        if(isset($fichaMedica)){
            //para traer de la relacion many to many los relacionados con esta ficha medica
            $sintomasDelAsistido=FichaMedica::find($fichaMedica->id)->sintomas;
            $consultasMedicas=ConsultaMedica::where('fichaMedica_id',$fichaMedica->id)->get();
            $profesionales=$fichaMedica->profesional()->get(); 
            $enfermedadesDelAsistido=$fichaMedica->enfermedades->all();
            $tratamientos=Tratamiento::where('fichaMedica_id',$fichaMedica->id)->get();
            $medicaciones=Medicacion::where('fichaMedica_id',$fichaMedica->id)->get();
            $intervenciones=Intervencion::where('fichaMedica_id',$fichaMedica->id)->get();
            $afeccionesGenericas=Afeccion::all();
            
            
            return view('altaFichas.fichaMedica')
                ->with('asistido',$asistido)
                ->with('sintomasGenericos',$sintomasGenericos)
                ->with('sintomasDelAsistido',$sintomasDelAsistido)
                ->with('profesionales',$profesionales)
                ->with('fichaMedica',$fichaMedica)
                ->with('medicaciones',$medicaciones)
                ->with('tratamientos',$tratamientos)
                ->with('intervenciones',$intervenciones)
                ->with('consultasMedicas',$consultasMedicas)
                ->with('enfermedadesGenericas',$enfermedadesGenericas)
                ->with('enfermedadesDelAsistido',$enfermedadesDelAsistido)
                ->with('afecciones',$afecciones)
                ->render();
        } else {
            $view = view('altaFichas.fichaMedica')->with('asistido',$asistido)->render();
        }
        
        return response()->json([
            'status' => true,
            'view' => $view,
        ]);

    }


    public function storeSintoma(Request $request,$asistido_id){

        Asistido::where('id',$asistido_id)->update(['checkFichaMedica' =>1]);
        $fichaMedica=$this->findFichaMedicaByAsistidoId($asistido_id);
        FichaMedica::where('asistido_id',$asistido_id)
        ->update(['checkSintomas'=>1]);

        $sintoma=Sintoma::find($request->sintoma); //contiene el id del sintoma, que viene del value del select de la vista
        $fichaMedica->sintomas()->attach($sintoma);
        return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);     

    }

    public function destroySintoma(Request $request){

        $sintoma_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $sintoma=Sintoma::find($sintoma_id);
        $fichaMedica=$this->findFichaMedicaByAsistidoId($asistido_id);
        $fichaMedica->sintomas()->detach($sintoma);
        
        return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);      
    

    }

    public function storeConsulta(Request $request, $asistido_id){

        Asistido::where('id',$asistido_id)->update(['checkFichaMedica' =>1]);
        $fichaMedica=$this->findFichaMedicaByAsistidoId($asistido_id);
        FichaMedica::where('asistido_id',$asistido_id)
        ->update(['checkConsultasMedicas'=>1]);
        $institucion=Institucion::create(['nombre'=>$request->nombreInstitucion]);
        
        $profesional=Profesional::create(['nombre'=>$request->nombreProfesional,'apellido'=>$request->apellidoProfesional,
        'especialidad'=>$request->especialidad]);
        $consulta=new ConsultaMedica(['fecha'=>$request->fecha,'diagnostico'=>$request->diagnostico]);
        $fichaMedica->consultasMedicas()->save($consulta);
        $institucion->consultasMedicas()->save($consulta);
        $profesional->consultasMedicas()->save($consulta);
        
        return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);    
    }

    public function destroyConsulta(Request $request){

        $consulta_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $consulta=ConsultaMedica::find($consulta_id);
        $fichaMedica=$this->findFichaMedicaByAsistidoId($asistido_id);
        $profesional=Profesional::find($consulta->profesional_id);
        $institucion=Institucion::find($consulta->institucion_id);
        if(isset($consulta)){
            $consulta->delete();
        }
        if(isset($profesional)){
            $profesional->delete();
        }
        
        if(isset($institucion)){
            $institucion->delete();
        }
        

        return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);      
    
    }

    public function storeProfesional(Request $request, $asistido_id){

        Asistido::where('id',$asistido_id)->update(['checkFichaMedica' =>1]);
        $fichaMedica=$this->findFichaMedicaByAsistidoId($asistido_id);
        FichaMedica::where('asistido_id',$asistido_id)
        ->update(['checkMedicoDeCabecera'=>1]);
        $profesional=Profesional::create(['nombre'=>$request->nombre,'apellido'=>$request->apellido,
        'especialidad'=>$request->especialidad]);
        $profesional->fichaMedica()->save($fichaMedica);
        
        return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);    
    }

    public function destroyProfesional(Request $request){
        $profesional_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $profesional=Profesional::find($profesional_id);
        $fichaMedica=$this->findFichaMedicaByAsistidoId($asistido_id);
        $fichaMedica->profesional()->dissociate();
        $fichaMedica->checkMedicoDeCabecera=0;
        $fichaMedica->save();
        $profesional->delete();

        return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);
    }

    public function storeEstadoGeneral(Request $request,$asistido_id){
        $fichaMedica=$this->findFichaMedicaByAsistidoId($asistido_id);

        if($request->checkAlergico=='on'){
            $alergicoValue=1;
        }else{
            $alergicoValue=0;
        }

        if($request->checkObraSocial=='on'){
            $obraSocialValue=1;
        }else{
            $obraSocialValue=0;
        }
        FichaMedica::where('asistido_id',$asistido_id)
        ->update(['altura'=>$request->altura,'peso'=>$request->peso,'checkAlergico'=>$alergicoValue,
        'checkObraSocial'=>$obraSocialValue,'alergicoA'=>$request->alergicoA,'obraSocial'=>$request->obraSocial,'antecedentes'=>$request->antecedentes]);

        return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);
    }

    public function storeEnfermedad(Request $request, $asistido_id){
        //falta obtener lo que esta dentro del dropdown , no lo esta agarrando
        //Con update me aseguro de no generar duplicados y solo actualizar el registro existente
        Asistido::where('id',$asistido_id)->update(['checkFichaMedica' =>1]);
        $fichaMedica=$this->findFichaMedicaByAsistidoId($asistido_id);
        FichaMedica::where('asistido_id',$asistido_id)
        ->update(['checkEnfermedades'=>1]);
        $enfermedad=Enfermedad::find($request->enfermedad);
        //fichaMedica_id en la clase adiccion tiene que ser fillable para que funcione con Eloquent
        $fichaMedica->enfermedades()->attach($enfermedad);
        return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);       
    }

    public function destroyEnfermedad(Request $request){

        $enfermedad_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $enfermedad=Enfermedad::find($enfermedad_id);
        $fichaMedica=$this->findFichaMedicaByAsistidoId($asistido_id);
        $fichaMedica->enfermedades()->detach($enfermedad);

        return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);

    }

    
    public function storeMedicacion(Request $request,$asistido_id){

        var_dump($request);
        if($request->has('nombre') && $request->has('droga') && ($request->input('nombre')!== null) && ($request->input('droga')!== null)){
            $profesional_input=$request->only(['nombre','apellido']);
            $medicacion_input=$request->only(['recetada','droga','dosis','frecuencia','receta','inicio','fin']);
            $profesional=new Profesional($profesional_input);
            $medicacion=new Medicacion($medicacion_input);
            $profesional->save();
            $profesional->medicacion()->save($medicacion);
        }
        
        if($request->has('droga') && ($request->input('droga')!== null) && ($request->input('nombre')== null)){
            $medicacion_input=$request->only(['recetada','droga','dosis','frecuencia','receta','inicio','fin']);
            $medicacion=new Medicacion($medicacion_input);
            $medicacion->save();
        }
        
        Asistido::where('id',$asistido_id)->update(['checkFichaMedica' =>1]);
        $fichaMedica=$this->findFichaMedicaByAsistidoId($asistido_id);
        FichaMedica::where('asistido_id',$asistido_id)
        ->update(['checkMedicacion'=>1]);
        $fichaMedica->medicaciones()->save($medicacion);

        //return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);
    }

    public function destroyMedicacion(Request $request){
        
        $medicacion_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $medicacion=Medicacion::find($medicacion_id);
        if(isset($medicacion->profesional)){
            $medicacion->delete();
            $profesional=$medicacion->profesional;
            $profesional->delete();
        }
        
        return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);
    }

    public function storeTratamiento(Request $request,$asistido_id){
        $tratamiento_input=$request->only(['tipo','inicio','fin','estado','causaDeFin']);
        $tratamiento=new Tratamiento($tratamiento_input);
        if($request->has('droga') && isset($request->droga)){
            $medicacion_input=$request->only(['droga','dosis','frecuencia']);
            $medicacion=new Medicacion($medicacion_input);
            $tratamiento->save();
            $tratamiento->medicaciones()->save($medicacion);
            $medicacion->save();
        }
        if($request->has('nombreInstitucion') && isset($request->nombreInstitucion)){
            $institucion=new Institucion;
            $institucion->nombre=$request->nombreInstitucion;
            $institucion->direccion=$request->direccionInstitucion;
            $institucion->email=$request->emailInstitucion;
            $tratamiento->save();
            $tratamiento->institucion()->save($institucion);

            $institucion->save();
        }
        if($request->has('nombre') && isset($request->nombre)){
            $profesional=new Profesional;
            $profesional->nombre=$request->nombre;
            $profesional->apellido=$request->apellido;
            $profesional->especialidad=$request->especialidadProfesional;
            $profesional->cargo=$request->cargoProfesional;
            $profesional->save();
            $tratamiento->profesional()->associate($profesional);
            $tratamiento->save();
        }

        Asistido::where('id',$asistido_id)->update(['checkFichaMedica' =>1]);
        $fichaMedica=$this->findFichaMedicaByAsistidoId($asistido_id);
        FichaMedica::where('asistido_id',$asistido_id)
        ->update(['checkTratamiento'=>1]);
        $fichaMedica->tratamientos()->save($tratamiento);
        $tratamiento->save();

        return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);
    }

    public function destroyTratamiento(Request $request){
        
        $tratamiento_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $tratamiento=Tratamiento::find($tratamiento_id);
        if(isset($tratamiento->medicaciones)){
            $medicacion=$tratamiento->medicaciones;
            $medicacion->delete();
        }
        if(isset($tratamiento->institucion)){
            $institucion=$tratamiento->institucion;
            $institucion->delete();
        }

        $tratamiento->delete();

        if(isset($tratamiento->profesional)){
            $profesional=$tratamiento->profesional;
            $profesional->delete();
        }
        


        return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);
    }


    public function storeIntervencion(Request $request, $asistido_id){

        $intervencion_input=$request->only(['diagnostico','tipoOperacion','fecha','tratamientoIndicado','medicacion']);
        $intervencion=new Intervencion($intervencion_input);
        FichaMedica::where('asistido_id',$asistido_id)
        ->update(['checkIntervencion'=>1]);
        $fichaMedica=$this->findFichaMedicaByAsistidoId($asistido_id);
        var_dump($fichaMedica);
        $intervencion->fichaMedica()->associate($fichaMedica);

        if($request->has('institucion') && isset($request->institucion)){

            $institucion=Institucion::create(['nombre'=>$request->institucion]);
            $institucion->save();
            $institucion->intervenciones()->save($intervencion);
        }
        if($request->has('medico') && isset($request->medico)){
            $profesional=Profesional::create(['nombre'=>$request->medico]);
            $profesional->save();
            $profesional->intervenciones()->save($intervencion);
        }
        Asistido::where('id',$asistido_id)->update(['checkFichaMedica' =>1]);
        
        return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);
    }

    public function destroyIntervencion(Request $request){

        $intervencion_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $intervencion=Intervencion::find($intervencion_id);
        $institucion=$intervencion->institucion;
        $profesional=$intervencion->profesional;
        $intervencion->delete();

        if(isset($institucion)){
            $institucion->delete();
        }

        if(isset($profesional)){
            $profesional->delete();
        }
        
        return redirect()->route('fichaMedica.create',['asistido_id'=>$asistido_id]);
    }

    public function findFichaMedicaByAsistidoId($asistido_id){
        $fichaMedica=FichaMedica::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(!isset($fichaMedica)){
            $fichaMedica=new FichaMedica();
            $fichaMedica->created_by = Auth::user()->id;
            $asistido->ficha()->save($fichaMedica);
            $asistido->update(['checkFichaMedica' =>1]);
        }
        return $fichaMedica;
    }
}
