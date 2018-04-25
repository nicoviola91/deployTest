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
Route::post('/alert/store','AlertaController@store');
Route::get('/alert/list','AlertaController@showAll');
Route::get('/alert/map','AlertaController@showMap');
Route::get('/alert/new', function() {
    return view('alertas.nueva');
});


Route::get('/','HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//ALTA FICHA DATOS PERSONALES
Route::get('/altaFicha/datosPersonales','FichaDatosPersonalesController@create');