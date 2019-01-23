<?php

namespace App\Http\Controllers;

use App\Asistido;
use App\Alerta;
use App\User;
use App\Comunidad;
use App\Institucion;
use App\Notifications\AltaAlerta;
use App\Notifications\altaAsistidoComunidad;
use Illuminate\Http\Request;
use App\Http\Requests\AsistidoRequest;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\DB;

class AsistidoController extends Controller
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
    public function createFromAlert($id)
    {
        $alerta=Alerta::find($id);

        $comunidades=Comunidad::all();
        $posaderos=Institucion::where('tipo', '=', 'posadero')->get();
        return view('asistidos.nuevoDesdeAlerta')->with('alerta',$alerta)->with('comunidades',$comunidades)->with('posaderos',$posaderos);
    }

    //para ir a la vista de creacion de un asistido cuando no se va desde una alerta
    public function create(){
        $comunidades=Comunidad::all();
        $posaderos=Institucion::where('tipo', '=', 'posadero')->get();

        return view('asistidos.nuevo')->with('comunidades',$comunidades)->with('posaderos',$posaderos);
    }

    public function verificarDocumentoExistente (Request $request) {

        $dni = $request->dni;

        // echo "DNI es " . $dni;
        $asistido = Asistido::where('dni', '=', $dni)->first();

        // echo "<br>";
        // echo var_dump($asistido);

        if (isset($asistido)) {

            if (isset($asistido->institucion)) {
                return response()->json([
                    'status' => true,
                    'asistido_id' => $asistido->id,
                    'asistido_nombre' => $asistido->nombre . ' ' . $asistido->apellido,
                    'posadero' => $asistido->institucion->nombre,
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'asistido_id' => $asistido->id,
                    'asistido_nombre' => $asistido->nombre . ' ' . $asistido->apellido,
                    'posadero' => 'No Especifica'
                ]);
            }
                
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Para guardar un asistido desde una Alerta
    public function store(Request $request,$alerta_id) 
    {

        $validation = $request->validate([
            'nombre' => 'required|string|max:250',
            'apellido' => 'required|string|max:250',
            'dni' => 'required|numeric',

            'fechaNacimiento' => 'nullable|date',
            'observaciones' => 'nullable|string',
        ]);

        $asistido=new Asistido($request->all());
        $alerta=Alerta::find($alerta_id);
        
        $asistido->createdBy=Auth::user()->id; //Usuario que creo el asistido
        $asistido->owner = $alerta->user_id; //Usuario que creo la alerta
        $asistido->user_id = Auth::user()->id;

        $asistido->save();
        /*Alerto al creadaor de la alerta*/
        $creador= $alerta->user;
        $creador->notify(new AltaAlerta($asistido));
        //Comunidad para alertar
        if (isset($alerta->comunidad_id)) {
            
            $comunidad=Comunidad::find($alerta->comunidad_id);
            $comunidad->asistidos()->save($asistido);
            /* Alerto a la comunidad del alta de un nuevo asistido
            if (isset($comunidad->users) && count($comunidad->users) > 0){
                foreach ($comunidad->users as $notificar) {
                    $notificar->notify(new altaAsistidoComunidad($asistido)); 
                }
            }*/
            
        }

        $alerta->asistido()->associate($asistido);
        $alerta->estado = 1;
        $alerta->institucion_id = $request->institucion_id;
        $alerta->save();

        return redirect()->route('asistido.show', ['id' => $asistido->id]);
    }

    //para guardar asistido cuando no es creado desde una alerta
    public function storeNew(Request $request)
    {   
        $validation = $request->validate([
            'nombre' => 'required|string|max:250',
            'apellido' => 'required|string|max:250',
            'dni' => 'required|numeric',

            'fechaNacimiento' => 'nullable|date',
            'observaciones' => 'nullable|string',
        ]);
        
        $asistido=new Asistido($request->all());
        
        $asistido->createdBy=Auth::user()->id;
        $asistido->owner = Auth::user()->id;
        $asistido->user_id = Auth::user()->id;

        if (isset($request->comunidad_id)) {
            
            $comunidad=Comunidad::find($request->comunidad_id);
            $comunidad->asistidos()->save($asistido);
            /* Alerto a la comunidad del alta de un nuevo asistido*/
            if (isset($comunidad->users) && count($comunidad->users) > 0){
                foreach ($comunidad->users as $notificar) {
                    $notificar->notify(new altaAsistidoComunidad($asistido)); 
                }
            }
        }
    
        $asistido->save();
        return redirect()->route('asistido.list');
    }

    public function updateImage (Request $request) {

        $validation = $request->validate([
            'foto' => 'required|file|mimes:jpeg,png,gif|max:20480'
        ]);

        $id = $request->id;
        $asistido = Asistido::where('id', $id)->first();

        if($request->hasFile('foto')) {

            //Si existe una imagen anterior, la elimino
            if (isset($asistido->foto) && $asistido->foto != '' && $asistido->foto != 'default.jpg'){
                
                if (file_exists(storage_path('app/public').'/'.$asistido->foto))
                    unlink(storage_path('app/public').'/'.$asistido->foto);
            }

            $image = $request->file('foto');
            $imageName = $image->getClientOriginalName();
            $fileName =  "asistido_" . sha1(microtime()) . '.' . pathinfo($imageName, PATHINFO_EXTENSION);

            $directory = storage_path('app/public');
            $imageUrl = $directory.'/'.$fileName;
            Image::make($image)->fit(200, 200)->save($imageUrl);

            if ($asistido->update(['foto' => $fileName]))
                return redirect()->back()->with('success','Actualizada correctamente.');
            else
                return redirect()->back()->with('error', 'Ocurrió un error al actualizar la imagen. Por favor vuelva a intentarlo.');
        } else {

            redirect()->back()->with('error', 'Ocurrió un error al actualizar la imagen. Debe seleccionar una imagen.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asistido  $asistido
     * @return \Illuminate\Http\Response
     */
   public function show ($asistido_id) 
    {
        $asistido = Asistido::find($asistido_id);
        $comunidades = Comunidad::all();

        return view('ficha')->with('asistido', $asistido)->with('comunidades', $comunidades)->with('vista', 'user');
    }
    public function show2 ($asistido_id) 
    {
        $asistido = Asistido::find($asistido_id);
        $comunidades = Comunidad::all();

        return view('ficha')->with('asistido', $asistido)->with('comunidades', $comunidades)->with('vista', 'admin');
    }

    public function agregarComunidad (Request $request) 
    {   
        $asistido_id = $request->asistido_id;
        $comunidad_id = $request->comunidad_id;

        $asistido = Asistido::find($asistido_id);
        
        if (!$asistido->comunidades()->where('comunidad_id', $comunidad_id)->exists()) {
            
            $asistido->comunidades()->attach($comunidad_id);
            /* Alerto a la comunidad del alta de un nuevo asistido*/
            $comunidad = Comunidad::where('id',$comunidad_id);
            if (isset($comunidad->users) && count($comunidad->users) > 0){
                foreach ($comunidad->users as $notificar) {
                    $notificar->notify(new altaAsistidoComunidad($asistido)); 
                }
            }

        }

        return redirect()->back();
    }


    public function showAll(){
        if(Auth::user()->tipoUsuario->slug == 'administrador' || Auth::user()->tipoUsuario->slug =='posadero'){
            $data['asistidos']=Asistido::all();
        }else{
            $data['asistidos']=Asistido::all()->where('owner',Auth::user()->id);
        }
        
        return view('asistidos.listado',$data);
    }


    public function misAsistidos(){

        //FAVORITOS
            //Se listan todos los favoritos que tiene *si ademas de ser favoritos tiene permiso por la comunidad a la que pertenece
        //Sino puede buscar entre todos sobre los cuales tiene permiso por DNI, nombre o apellido:
            //ADMINISTRADOR busca en TODOS
            //POSADERO busca en TODOS
            //COORDINADOR/PROFESIONAL buscan en los que tiene permiso segun la COMUNIDAD a la que pertenecen
    
        return view('asistidos.misAsistidos');
    }

    public function busqueda(Request $request) {

        $validatedData = $request->validate([
            'q' => 'required|string',
        ]);

        $data['q'] = $request->q;

        switch ($request->tipo) {
            case 'asistido':
                if(Auth::user()->tipoUsuario->slug == 'administrador' || Auth::user()->tipoUsuario->slug =='posadero'){
                    $data['asistidos'] = Asistido::where('nombre', 'like', '%' . $request->q . '%')
                                            ->orWhere('apellido', 'like', '%' . $request->q . '%')
                                            ->orWhereRaw('CONCAT(nombre," ", apellido) LIKE ?', '%' . $request->q . '%')
                                            ->orWhere('dni', 'like', '%' . $request->q . '%')->get(); 

                }else{
                    $data['asistidos'] = Asistido::where(function ($query) {
                        $query->where('owner', '=', Auth::user()->id);
                    })->where(function ($query) use ($c,$d) {
                        $query->where('nombre', 'like', '%' . $request->q . '%')
                            ->orWhere('apellido', 'like', '%' . $request->q . '%')
                            ->orWhereRaw('CONCAT(nombre," ", apellido) LIKE ?', '%' . $request->q . '%')
                            ->orWhere('dni', 'like', '%' . $request->q . '%');
                    });
                }
                break;
            
            default:
                # code...
                break;
        }
        
        return view('asistidos.busqueda',$data);
    }


     public function buscar(Request $request) {

        $validatedData = $request->validate([
            'q' => 'required|regex:^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$^',
        ]);

        $data['q'] = $request->q;

        //SI ES ADMINISTRADOR O POSADERO BUSCA ENTRE TODOS
        if(Auth::user()->tipoUsuario->slug == 'administrador' || Auth::user()->tipoUsuario->slug =='posadero'){

            $data['asistidos'] = DB::table('asistidos')
            ->select(DB::raw('asistidos.*, instituciones.nombre AS institucion'))
            ->leftJoin('instituciones', 'asistidos.institucion_id', '=', 'instituciones.id')
            ->orWhere('asistidos.nombre', 'like', '%' . $request->q . '%')
            ->orWhere('asistidos.apellido', 'like', '%' . $request->q . '%')
            ->orWhereRaw('CONCAT(asistidos.nombre," ", asistidos.apellido) LIKE ?', '%' . $request->q . '%')
            ->orWhere('asistidos.dni', 'like', '%' . $request->q . '%')
            ->get();

        //SI ES COORDINADOR O PROFESIONAL BUSCA ENTRE LOS DE SU COMUNIDAD
        } else if (Auth::user()->tipoUsuario->slug == 'profesional' || Auth::user()->tipoUsuario->slug =='coordinador') {
          
            $data['asistidos'] = DB::select("SELECT DISTINCT asistidos.*, instituciones.nombre AS institucion FROM asistidos LEFT JOIN instituciones ON asistidos.institucion_id = instituciones.id LEFT JOIN asistido_comunidad ON asistidos.id = asistido_comunidad.asistido_id WHERE ((asistidos.nombre LIKE '%".$request->q."%') OR (asistidos.apellido LIKE '%".$request->q."%') OR (CONCAT(asistidos.nombre, ' ', asistidos.apellido) LIKE '%".$request->q."%') OR (asistidos.dni LIKE '%".$request->q."%')) AND asistido_comunidad.comunidad_id IN (SELECT comunidad_user.comunidad_id FROM comunidad_user WHERE comunidad_user.user_id = '".Auth::user()->id."')");
                    
        } else {

            $data['asistidos'] = null;
        }
                
        $resultados=$data['asistidos'];

        $view = view('asistidos.resultados')
        ->with('resultados',$resultados)
        ->render();

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asistido  $asistido
     * @return \Illuminate\Http\Response
     */
    public function edit(Asistido $asistido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asistido  $asistido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asistido $asistido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asistido  $asistido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asistido $asistido)
    {
        //
    }
}
