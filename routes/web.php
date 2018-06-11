<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Default Route a raiz
Route::get('/', function () {
    return view('auth/login');
});

//Prueba para ver vista ficha
Route::get('/ficha', function () {
    return view('ficha');
});

//USERS
Route::get('/user/create','UserController@create');
Route::get('/user/list','UserController@showAll');
Route::get('/user/profile','UserController@profile');
Route::post('/user/store','UserController@store');

//ALERTAS
Route::group(['prefix'=>'alert'],function(){
    Route::get('/new',function(){
        return view('alertas.nueva');
    });
    Route::post('/store',[
        'uses'=>'AlertaController@store',
        'as'=>'alerta.store'
    ]);
    Route::get('/list',[
        'uses'=>'AlertaController@showAll',
        'as'=>'alerta.list'
    ]);
    Route::get('/map',[
        'uses'=>'AlertaController@showMap',
        'as'=>'alerta.showMap'
    ]);
    Route::get('/destroy/{id}',[
        'uses'=>'AlertaController@destroy',
        'as'=>'alerta.destroy'
    ]);
});

//INSTITUCIONES
Route::group(['prefix'=>'institucion'],function(){
    Route::post('/store',[
        'uses'=>'InstitucionController@store',
        'as'=>'institucion.store'
    ]);
    Route::get('/list',[
        'uses'=>'InstitucionController@showAll',
        'as'=>'institucion.list'
    ]);
    Route::get('/destroy/{id}',[
        'uses'=>'InstitucionController@destroy',
        'as'=>'institucion.destroy'
    ]);
});

//COMUNIDADES
Route::group(['prefix'=>'comunidad'],function(){
    Route::post('/store',[
        'uses'=>'ComunidadController@store',
        'as'=>'comunidad.store'
    ]);
    Route::get('/list',[
        'uses'=>'ComunidadController@showAll',
        'as'=>'comunidad.list'
    ]);
    Route::get('/destroy/{id}',[
        'uses'=>'ComunidadController@destroy',
        'as'=>'comunidad.destroy'
    ]);
});

//ASISTIDOS
Route::group(['prefix'=>'asistido'],function(){
    Route::get('/newFromAlert/{id}',[
        'uses'=>'AsistidoController@createFromAlert',
        'as'=>'asistido.newFromAlert'
    ]);
    Route::post('/store/{alerta_id}',[
        'uses'=>'AsistidoController@store',
        'as'=>'asistido.store',
    ]);
    Route::get('/list',[
        'uses'=>'AsistidoController@showAll',
        'as'=>'asistido.list'
    ]);
    Route::get('/show/{id}',[
        'uses'=>'AsistidoController@show',
        'as'=>'asistido.show'
    ]);
    Route::get('/show2/{id}',[
        'uses'=>'AsistidoController@show2',
        'as'=>'asistido.show2'
    ]);
});

//CONSULTAS/INTERACCIONES
Route::group(['prefix'=>'consultas'],function(){
    Route::post('/store',[
        'uses'=>'ConsultaController@store',
        'as'=>'consulta.store'
    ]);
});


//FICHA DATOS PERSONALES
Route::group(['prefix'=>'fichaDatosPersonales'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaDatosPersonalesController@create',
        'as'=>'fichaDatosPersonales.create',
    ]);
    Route::post('/store/{asistido_id}',[
        'uses'=>'FichaDatosPersonalesController@store',
        'as'=>'fichaDatosPersonales.store'
    ]);
});

//FICHA ADICCIONES
Route::group(['prefix'=>'fichaAdicciones'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaAdiccionesController@create',
        'as'=>'fichaAdicciones.create',
    ]);
    Route::post('/storeAdiccion/{id}',[
        'uses'=>'FichaAdiccionesController@storeAdiccion',
        'as'=>'fichaAdicciones.storeAdiccion',
    ]);
    Route::post('/storeEpisodioAgresivo/{id}',[
        'uses'=>'FichaAdiccionesController@storeEpisodioAgresivo',
        'as'=>'fichaAdicciones.storeEpisodioAgresivo',
    ]);
    Route::post('/storeTratamiento/{id}',[
        'uses'=>'FichaAdiccionesController@storeTratamiento',
        'as'=>'fichaAdicciones.storeTratamiento',
    ]);
    Route::post('/storeConsideraciones/{id}',[
        'uses'=>'FichaAdiccionesController@storeConsideraciones',
        'as'=>'fichaAdicciones.storeConsideraciones',
    ]);
    Route::get('/destroyAdiccion/{adiccion_id}/{asistido_id}',[
        'uses'=>'FichaAdiccionesController@destroyAdiccion',
        'as'=>'fichaAdicciones.destroyAdiccion'
    ]);
    Route::get('/destroyEpisodioAgresivo/{episodioAgresivo_id}/{asistido_id}',[
        'uses'=>'FichaAdiccionesController@destroyEpisodioAgresivo',
        'as'=>'fichaAdicciones.destroyEpisodioAgresivo'
    ]);
    Route::get('/destroyTratamiento/{tratamiento_id}/{asistido_id}',[
        'uses'=>'FichaAdiccionesController@destroyTratamiento',
        'as'=>'fichaAdicciones.destroyTratamiento'
    ]);
});

//FICHA FAMILIA Y AMIGOS
Route::group(['prefix'=>'fichaFamiliaAmigos'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaFamiliaAmigosController@create',
        'as'=>'fichaFamiliaAmigos.create',
    ]);
    Route::post('/storeContacto/{id}',[
        'uses'=>'FichaFamiliaAmigosController@storeContacto',
        'as'=>'fichaFamiliaAmigos.storeContacto',
    ]);
    Route::get('/destroyContacto/{contacto_id}/{asistido_id}',[
        'uses'=>'FichaFamiliaAmigosController@destroyContacto',
        'as'=>'fichaFamiliaAmigos.destroyContacto',
    ]);
});

//FICHA EDUCACION
Route::group(['prefix'=>'fichaEducacion'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaEducacionController@create',
        'as'=>'fichaEducacion.create',
    ]);
    Route::post('/storeEducacion/{id}',[
        'uses'=>'FichaEducacionController@storeEducacion',
        'as'=>'fichaEducacion.storeEducacion',
    ]);
    Route::get('/destroyEducacion/{educacion_id}/{asistido_id}',[
        'uses'=>'fichaEducacionController@destroyEducacion',
        'as'=>'fichaEducacion.destroyEducacion',
    ]);
});

//FICHA LOCALIZACION
Route::group(['prefix'=>'FichaLocalizacion'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaLocalizacionController@create',
        'as'=>'FichaLocalizacion.create',
    ]);
    Route::post('/storeLocalizacion/{id}',[
        'uses'=>'FichaLocalizacionController@storeLocalizacion',
        'as'=>'FichaLocalizacion.storeLocalizacion',
    ]);
    Route::get('/destroyLocalizacion/{id}/{asistido_id}/{localizacionOZona}',[
        'uses'=>'FichaLocalizacionController@destroyLocalizacion',
        'as'=>'FichaLocalizacion.destroyLocalizacion',
    ]);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home', function () {
//     echo "SE LOGEO CORRECTAMENTE";
// });


