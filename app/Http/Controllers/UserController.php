<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\AltaUsuario;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Routing\Route;
use Illuminate\Routing\Redirector;
use App\Http\Requests\UserRequest;
use App\TipoUsuario;

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
        $asistido = Asistido::where('id', $id)->first();

        if($request->hasFile('foto')) {

            //Si existe una imagen anterior, la elimino
            if (isset($asistido->foto) && $asistido->foto != '' && $asistido->foto != 'default.jpg'){
                
                if (file_exists(storage_path('app/public').'/'.$asistido->foto))
                    unlink(storage_path('app/public').'/'.$asistido->foto);
            }

            $image = $request->file('foto');
            $imageName = $image->getClientOriginalName();
            $fileName =  "user_" . sha1(microtime()) . '.' . pathinfo($imageName, PATHINFO_EXTENSION);

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
}
