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

/*Route::get('/', function () {
    return view('welcome');
});*/

//USERS
Route::get('/user/create','UserController@create');
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
});


Route::get('/','HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//ALTA FICHA DATOS PERSONALES
Route::get('/altaFicha/datosPersonales','FichaDatosPersonalesController@create');

