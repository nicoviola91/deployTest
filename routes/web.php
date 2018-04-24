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

Route::get('testing', function() {
    return view('altaFichas.fichaDatosPersonales');
});

Route::get('/','HomeController@index');

Route::get('/user/create','UserController@create');

Route::post('/user/store','UserController@store')->name('userStore');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
