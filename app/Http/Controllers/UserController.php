<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Institucion;
use App\Comunidad;
use App\Notifications\AltaUsuario;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Routing\Route;
use Illuminate\Routing\Redirector;
use App\Http\Requests\UserRequest;
use App\TipoUsuario;

use Image;

class UserController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserRequest $request){
        return view('users.create');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */    
    public function store(UserRequest $request)
    {
    
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $tipoUsuario=TipoUsuario::all()->where('descripcion','Nuevo Usuario')->first();//Por defecto cada usuario recien registrado sera del tipo Nuevo Usuario
        $tipoUsuario_id=$tipoUsuario->id;
        $user->tipoUsuario()->associate($tipoUsuario_id); 
        $user->save();
        
        $user->notify(new AltaUsuario($user));
        return view('auth.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource's profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id = false)
    {   
        if (!$id) 
            $id = Auth::id();

        $data['user'] = User::find($id);

        return view('users.profile', $data);
    }

    public function profile2(Request $request, $id)
    {   
        $data['user'] = User::find($id);

        return view('users.profile2', $data);
    }


    /**
     * Display the specified resource list.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $data['usuarios'] = User::all();
        $data['tipos'] = TipoUsuario::all();
        $data['comunidades'] = Comunidad::all();
        $data['instituciones'] = Institucion::all();
        return view('users.listado', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateImage (Request $request) {

        $validation = $request->validate([
            'foto' => 'required|file|mimes:jpeg,png,gif|max:20480'
        ]);

        $id = $request->id;
        $usuario = User::where('id', $id)->first();

        if($request->hasFile('foto')) {

            //Si existe una imagen anterior, la elimino
            if (isset($usuario->imagen) && $usuario->imagen != '' && $usuario->imagen != 'default.jpg'){
                
                if (file_exists(storage_path('app/public').'/'.$usuario->imagen))
                    unlink(storage_path('app/public').'/'.$usuario->imagen);
            }

            $image = $request->file('foto');
            $imageName = $image->getClientOriginalName();
            $fileName =  "user_" . sha1(microtime()) . '.' . pathinfo($imageName, PATHINFO_EXTENSION);

            $directory = storage_path('app/public');
            $imageUrl = $directory.'/'.$fileName;
            Image::make($image)->fit(200, 200)->save($imageUrl);

            $usuario->update(['imagen' => $fileName]);

            if ($usuario->update(['imagen' => $fileName]))
                return redirect()->back()->with('success','Actualizada correctamente.');
            else
                return redirect()->back()->with('error', 'Ocurrió un error al actualizar la imagen. Por favor vuelva a intentarlo.');
        } else {

            redirect()->back()->with('error', 'Ocurrió un error al actualizar la imagen. Debe seleccionar una imagen.');
        }

    }

    public function acuerdo (Request $request) {

        //Verificar que id es numeric, existe y sea un usuario valido
        //Verificar que valor es boolean

        $id = $request->id;
        $valor = $request->valor;

        $usuario = User::where('id', $id)->first();

        if ($usuario->update(['chkFirmoAcuerdo' => $valor])) {
            
            return response()->json([
                'status' => true,
                'msg' => 'Actualizado correctamente',
            ]);

        } else {
            
            return response()->json([
                'status' => false,
                'msg' => 'Ocurrió un error al realizar la operación.',
            ]);
        }
    }

    public function updateType (Request $request) {

        //Verificar que id es numeric, existe y sea un usuario valido
        //Verificar que valor es boolean

        $id = $request->id;
        $tipo = $request->tipo;

        $usuario = User::where('id', $id)->first();

        if ($usuario->update(['tipoUsuario_id' => $tipo])) {
            
            return response()->json([
                'status' => true,
                'id' => $usuario->tipoUsuario_id,
                'msg' => 'Actualizado correctamente',
            ]);

        } else {
            
            return response()->json([
                'status' => false,
                'id' => $usuario->tipoUsuario_id,
                'msg' => 'Ocurrió un error al realizar la operación.',
            ]);
        }
    }

    public function updateInstitucion (Request $request) {

        //Verificar que id es numeric, existe y sea un usuario valido
        //Verificar que valor es boolean

        $id = $request->id;
        $institucion = $request->institucion;

        $usuario = User::where('id', $id)->first();

        if ($usuario->update(['institucion_id' => $institucion])) {
            
            return response()->json([
                'status' => true,
                'id' => $usuario->institucion_id,
                'msg' => 'Actualizado correctamente',
            ]);

        } else {
            
            return response()->json([
                'status' => false,
                'id' => $usuario->institucion_id,
                'msg' => 'Ocurrió un error al realizar la operación.',
            ]);
        }
    }

    public function updateComunidad (Request $request) {

        //Verificar que id es numeric, existe y sea un usuario valido
        //Verificar que valor es boolean

        $id = $request->id;
        $comunidad = $request->comunidad;

        $usuario = User::where('id', $id)->first();

        if ($usuario->update(['comunidad_id' => $comunidad])) {
            
            return response()->json([
                'status' => true,
                'id' => $usuario->comunidad_id,
                'msg' => 'Actualizado correctamente',
            ]);

        } else {
            
            return response()->json([
                'status' => false,
                'id' => $usuario->comunidad_id,
                'msg' => 'Ocurrió un error al realizar la operación.',
            ]);
        }
    }

    
}
