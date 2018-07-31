<?php

namespace App\Http\Controllers;

use App\Asistido;
use App\Alerta;
use App\User;
use App\Notifications\AltaAlerta;
use Illuminate\Http\Request;
use App\Http\Requests\AsistidoRequest;
use Illuminate\Support\Facades\Auth;
use Image;

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
        $alerta->estado=1;
        $alerta->save();
        return view('asistidos.nuevoDesdeAlerta')->with('alerta',$alerta);
    }

    //para ir a la vista de creacion de un asistido cuando no se va desde una alerta
    public function create(){
        return view('asistidos.nuevo');
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

        $asistido=new Asistido($request->all());
        $alerta=Alerta::find($alerta_id);
        $asistido->createdBy=Auth::user()->email;
        $asistido->owner = $alerta->user_id;
        $asistido->save(); 
        $usuario = $alerta->user_id;
        $usuarioNotif = User::find($usuario);
        #$usuarioNotif->notify(new AltaAlerta($alerta));
        $usuarioNotif->notify(new AltaAlerta($alerta));
        $alerta->asistido()->associate($asistido);
        $alerta->estado = 1;
        $alerta->save();
        return redirect()->route('asistido.list');
    }

    //para guardar asistido cuando no es creado desde una alerta
    public function storeNew(Request $request)
    {
        $asistido=new Asistido($request->all());
        $asistido->createdBy=Auth::user()->email;
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
    public function show($asistido_id)
    {
        $asistido=Asistido::find($asistido_id);

        return view('asistidos.detalleAsistido')->with('asistido',$asistido);
    }

    public function show2 ($asistido_id) 
    {
        $asistido = Asistido::find($asistido_id);

        return view('ficha')->with('asistido', $asistido);
    }


    public function showAll(){
        if(Auth::user()->tipoUsuario->descripcion == 'Administrador' || Auth::user()->tipoUsuario->descripcion =='Posadero'){
            $data['asistidos']=Asistido::all();
        }else{
            $data['asistidos']=Asistido::all()->where('owner',Auth::user()->id);
        }
        
        return view('asistidos.listado',$data);
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
