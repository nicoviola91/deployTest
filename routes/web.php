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

//Downloads
Route::get('/download/{path}/{file}', 'DownloadsController@download');

//USERS
//TODO COMO FILTRAMOS CON MIDDLEWARE ESTAS RUTAS?

Route::get('/user/create','UserController@create');
Route::get('/user/list','UserController@showAll');
Route::get('/user/profile','UserController@profile');
Route::post('/user/store','UserController@store');

//ALERTAS
//TODO esto deberia poder verse siendo usuario Samaritano, pero no se ve. Ver si
//TODO el orden esta afectando
Route::group(['prefix'=>'alert','middleware'=>['generarAlertas','admin']],function(){
    Route::get('/new',function(){
        return view('alertas.nueva');
    });

    Route::post('/store',[
        'uses'=>'AlertaController@store',
        'as'=>'alerta.store'
    ]);
    Route::post('/storeNew',[
        'uses'=>'AlertaController@storeNew',
        'as'=>'alerta.storeNew'
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
Route::group(['prefix'=>'asistido','middleware'=>'admin'],function(){
    Route::get('/newFromAlert/{id}',[
        'uses'=>'AsistidoController@createFromAlert',
        'as'=>'asistido.newFromAlert'
    ]);
    Route::get('/new',[
        'uses'=>'AsistidoController@create',
        'as'=>'asistidos.nuevo'
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
Route::group(['prefix'=>'consultas','middleware'=>'admin'],function(){
    Route::post('/store',[
        'uses'=>'ConsultaController@store',
        'as'=>'consultas.store'
    ]);
    Route::get('/getView/{id}/{type}',[
        'uses'=>'ConsultaController@getView',
        'as'=>'consultas.getView',
    ]);
});


//FICHA DATOS PERSONALES
Route::group(['prefix'=>'fichaDatosPersonales','middleware'=>'admin'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaDatosPersonalesController@create',
        'as'=>'fichaDatosPersonales.create',
    ]);
    Route::get('/get/{id}',[
        'uses'=>'FichaDatosPersonalesController@get',
        'as'=>'fichaDatosPersonales.get',
    ]);
    Route::post('/store/{asistido_id}',[
        'uses'=>'FichaDatosPersonalesController@store',
        'as'=>'fichaDatosPersonales.store'
    ]);
});

//FICHA ADICCIONES
Route::group(['prefix'=>'fichaAdicciones','middleware'=>'admin'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaAdiccionesController@create',
        'as'=>'fichaAdicciones.create',
    ]);
    Route::get('/get/{id}',[
        'uses'=>'FichaAdiccionesController@get',
        'as'=>'fichaAdicciones.get',
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
Route::group(['prefix'=>'fichaFamiliaAmigos' ,'middleware'=>'admin'],function(){
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
Route::group(['prefix'=>'fichaEducacion','middleware'=>'admin'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaEducacionController@create',
        'as'=>'fichaEducacion.create',
    ]);
    Route::get('/get/{id}',[
        'uses'=>'FichaEducacionController@get',
        'as'=>'fichaEducacion.get',
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
Route::group(['prefix'=>'FichaLocalizacion','middleware'=>'admin'],function(){
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

//FICHA EMPLEO
Route::group(['prefix'=>'fichaEmpleo','middleware'=>'admin'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaEmpleoController@create',
        'as'=>'fichaEmpleo.create',
    ]);
    Route::get('/get/{id}',[
        'uses'=>'FichaEmpleoController@get',
        'as'=>'fichaEmpleo.get',
    ]);
    Route::post('/storeEmpleo/{id}',[
        'uses'=>'FichaEmpleoController@storeEmpleo',
        'as'=>'fichaEmpleo.storeEmpleo',
    ]);
    Route::post('/storeConsideraciones/{id}',[
        'uses'=>'FichaEmpleoController@storeConsideraciones',
        'as'=>'fichaEmpleo.storeConsideraciones',
    ]);
    Route::get('/destroyEmpleo/{id}/{asistido_id}',[
        'uses'=>'FichaEmpleoController@destroyEmpleo',
        'as'=>'fichaEmpleo.destroyEmpleo',
    ]);
});

//FICHA LEGAL
Route::group(['prefix'=>'fichaLegal','middleware'=>'admin'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaLegalController@create',
        'as'=>'fichaLegal.create',
    ]);
    Route::get('/get/{id}',[
        'uses'=>'FichaLegalController@get',
        'as'=>'fichaLegal.get',
    ]);
    Route::post('/storeAntecedente/{id}',[
        'uses'=>'FichaLegalController@storeAntecedente',
        'as'=>'fichaLegal.storeAntecedente',
    ]);
    Route::get('/destroyAntecedente/{id}/{asistido_id}',[
        'uses'=>'FichaLegalController@destroyAntecedente',
        'as'=>'fichaLegal.destroyAntecedente',
    ]);
});

//FICHA NECESIDADES
Route::group(['prefix'=>'fichaNecesidades','middleware'=>'admin'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaNecesidadesController@create',
        'as'=>'fichaNecesidades.create',
    ]);
    Route::post('/storeNecesidad/{id}',[
        'uses'=>'FichaNecesidadesController@storeNecesidad',
        'as'=>'fichaNecesidades.storeNecesidad',
    ]);
    Route::get('/destroyNecesidad/{id}/{asistido_id}',[
        'uses'=>'FichaNecesidadesController@destroyNecesidad',
        'as'=>'fichaNecesidades.destroyNecesidad',
    ]);
});

//FICHA ASISTENCIA SOCIAL
Route::group(['prefix'=>'fichaAsistenciaSocial','middleware'=>'admin'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaAsistenciaSocialController@create',
        'as'=>'fichaAsistenciaSocial.create',
    ]);
    Route::post('/storeServicio/{id}',[
        'uses'=>'FichaAsistenciaSocialController@storeServicio',
        'as'=>'fichaAsistenciaSocial.storeServicio',
    ]);
    Route::delete('/destroyServicio/{id}/{asistido_id}',[
        'uses'=>'FichaAsistenciaSocialController@destroyServicio',
        'as'=>'fichaAsistenciaSocial.destroyServicio',
    ]);
});



//FICHA DIAGNOSTICO INTEGRAL
Route::group(['prefix'=>'fichaDiagnosticoIntegral','middleware'=>'admin'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaDiagnosticoIntegralController@create',
        'as'=>'fichaDiagnosticoIntegral.create',
    ]);
    Route::post('/storeCurso/{id}',[
        'uses'=>'FichaDiagnosticoIntegralController@storeCurso',
        'as'=>'fichaDiagnosticoIntegral.storeCurso',
    ]);
    Route::post('/storeDiagnostico/{id}',[
        'uses'=>'FichaDiagnosticoIntegralController@storeDiagnostico',
        'as'=>'fichaDiagnosticoIntegral.storeDiagnostico',
    ]);
    Route::get('/destroyCurso/{id}/{asistido_id}',[
        'uses'=>'FichaDiagnosticoIntegralController@destroyCurso',
        'as'=>'fichaDiagnosticoIntegral.destroyCurso',
    ]);
});


//FICHA SALUD MENTAL
Route::group(['prefix'=>'fichaSaludMental','middleware'=>'admin'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaSaludMentalController@create',
        'as'=>'fichaSaludMental.create',
    ]);
    Route::get('/get/{id}',[
        'uses'=>'FichaSaludMentalController@get',
        'as'=>'fichaSaludMental.get',
    ]);
    Route::post('/storePatologia/{id}',[
        'uses'=>'FichaSaludMentalController@storePatologia',
        'as'=>'fichaSaludMental.storePatologia',
    ]);
    Route::post('/storeEpisodioAgresivo/{id}',[
        'uses'=>'FichaSaludMentalController@storeEpisodioAgresivo',
        'as'=>'fichaSaludMental.storeEpisodioAgresivo',
    ]);
    Route::post('/storeTratamiento/{id}',[
        'uses'=>'FichaSaludMentalController@storeTratamiento',
        'as'=>'fichaSaludMental.storeTratamiento',
    ]);
    Route::post('/storeMedicacion/{id}',[
        'uses'=>'FichaSaludMentalController@storeMedicacion',
        'as'=>'fichaSaludMental.storeMedicacion',
    ]);
    Route::post('/storeConsideraciones/{id}',[
        'uses'=>'FichaSaludMentalController@storeConsideraciones',
        'as'=>'fichaSaludMental.storeConsideraciones',
    ]);
    Route::get('/destroyMedicacion/{medicacion_id}/{asistido_id}',[
        'uses'=>'FichaSaludMentalController@destroyMedicacion',
        'as'=>'fichaSaludMental.destroyMedicacion'
    ]);
    Route::get('/destroyPatologia/{patologia_id}/{asistido_id}',[
        'uses'=>'FichaSaludMentalController@destroyPatologia',
        'as'=>'fichaSaludMental.destroyPatologia'
    ]);
    Route::get('/destroyEpisodioAgresivo/{episodioAgresivo_id}/{asistido_id}',[
        'uses'=>'FichaSaludMentalController@destroyEpisodioAgresivo',
        'as'=>'fichaSaludMental.destroyEpisodioAgresivo'
    ]);
    Route::get('/destroyTratamiento/{tratamiento_id}/{asistido_id}',[
        'uses'=>'FichaSaludMentalController@destroyTratamiento',
        'as'=>'fichaSaludMental.destroyTratamiento'
    ]);
});


//FICHA MEDICA
Route::group(['prefix'=>'fichaMedica','middleware'=>'admin'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaMedicaController@create',
        'as'=>'fichaMedica.create',
    ]);
    Route::get('/get/{id}',[
        'uses'=>'FichaMedicaController@get',
        'as'=>'fichaMedica.get',
    ]);
    Route::post('/storeSintoma/{id}',[
        'uses'=>'FichaMedicaController@storeSintoma',
        'as'=>'fichaMedica.storeSintoma',
    ]);
    Route::post('/storeProfesional/{id}',[
        'uses'=>'FichaMedicaController@storeProfesional',
        'as'=>'fichaMedica.storeProfesional',
    ]);
    Route::post('/storeConsulta/{id}',[
        'uses'=>'FichaMedicaController@storeConsulta',
        'as'=>'fichaMedica.storeConsulta',
    ]);
    Route::post('/storeTratamiento/{id}',[
        'uses'=>'FichaMedicaController@storeTratamiento',
        'as'=>'fichaMedica.storeTratamiento',
    ]);
    Route::post('/storeMedicacion/{id}',[
        'uses'=>'FichaMedicaController@storeMedicacion',
        'as'=>'fichaMedica.storeMedicacion',
    ]);
    Route::post('/storeEnfermedad/{id}',[
        'uses'=>'FichaMedicaController@storeEnfermedad',
        'as'=>'fichaMedica.storeEnfermedad',
    ]);
    
    Route::post('/storeEstadoGeneral/{id}',[
        'uses'=>'FichaMedicaController@storeEstadoGeneral',
        'as'=>'fichaMedica.storeEstadoGeneral',
    ]);
    Route::post('/storeIntervencion/{id}',[
        'uses'=>'FichaMedicaController@storeIntervencion',
        'as'=>'fichaMedica.storeIntervencion',
    ]);
    Route::get('/destroyProfesional/{profesional_id}/{asistido_id}',[
        'uses'=>'FichaMedicaController@destroyProfesional',
        'as'=>'fichaMedica.destroyProfesional'
    ]);
    Route::get('/destroyMedicacion/{medicacion_id}/{asistido_id}',[
        'uses'=>'FichaMedicaController@destroyMedicacion',
        'as'=>'fichaMedica.destroyMedicacion'
    ]);
    Route::get('/destroyConsulta/{consulta_id}/{asistido_id}',[
        'uses'=>'FichaMedicaController@destroyConsulta',
        'as'=>'fichaMedica.destroyConsulta'
    ]);
    Route::get('/destroySintoma/{sintoma_id}/{asistido_id}',[
        'uses'=>'FichaMedicaController@destroySintoma',
        'as'=>'fichaMedica.destroySintoma'
    ]);
    Route::get('/destroyTratamiento/{tratamiento_id}/{asistido_id}',[
        'uses'=>'FichaMedicaController@destroyTratamiento',
        'as'=>'fichaMedica.destroyTratamiento'
    ]);
    Route::get('/destroyEnfermedad/{enfermedad_id}/{asistido_id}',[
        'uses'=>'FichaMedicaController@destroyEnfermedad',
        'as'=>'fichaMedica.destroyEnfermedad'
    ]);
    Route::get('/destroyIntervencion/{intervencion_id}/{asistido_id}',[
        'uses'=>'FichaMedicaController@destroyIntervencion',
        'as'=>'fichaMedica.destroyIntervencion'
    ]);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home', function () {
//     echo "SE LOGEO CORRECTAMENTE";
// });


