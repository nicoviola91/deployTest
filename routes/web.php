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

    if(Auth::check()) {
        return redirect()->route('home');
    }else {
        return redirect()->route('login');
    }
});

Auth::routes();

//middleware('userType:admin,Administrador,Posadero, Nuevo Usuario, Samaritano');

//Dashboard
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard')->middleware('userType:administrador,posadero');

Route::get('/actividad/{id}/{offset}', 'ComunidadController@getActividadReciente'); //*M verComunidad(id)
Route::get('/alertas/misActualizaciones/{offset}', 'AlertaController@misActualizaciones')->middleware('autenticado'); 

//Bienvenido
Route::get('/home', 'HomeController@home')->name('home')->middleware('autenticado');
Route::get('/uca', 'HomeController@uca')->name('uca')->middleware('autenticado');

//Downloads (para archivos de consultas)
Route::get('/download/{path}/{file}', 'DownloadsController@download')->middleware('userType:administrador,posadero,coordinador,profesional');

//USERS
Route::group(['prefix'=>'user'], function(){
    
    Route::get('/create',[
        'uses'=>'UserController@create',
        'as'=>'user.create'
    ]);
    
    Route::post('/updateImage',[
        'uses'=>'UserController@updateImage',
        'as'=>'user.updateImage',
    ])->middleware('autenticado');
    
    Route::post('/update/{id}',[
        'uses'=>'UserController@update',
        'as'=>'user.update',
    ])->middleware('userType:administrador,posadero');
    
    Route::post('/agregarComunidad',[
        'uses'=>'UserController@agregarComunidad',
        'as'=>'user.agregarComunidad',
    ])->middleware('userType:administrador,posadero,coordinador');
    
    Route::post('/acuerdo',[
        'uses'=>'UserController@acuerdo',
        'as'=>'user.acuerdo',
    ])->middleware('userType:administrador,posadero,coordinador');
    
    Route::post('/updateType',[
        'uses'=>'UserController@updateType',
        'as'=>'user.updateType',
    ])->middleware('userType:administrador,posadero,coordinador');
    
    Route::post('/updateInstitucion',[
        'uses'=>'UserController@updateInstitucion',
        'as'=>'user.updateInstitucion',
    ])->middleware('userType:administrador,posadero,coordinador');
    
    Route::post('/updateComunidad',[
        'uses'=>'UserController@updateComunidad',
        'as'=>'user.updateComunidad',
    ])->middleware('userType:administrador,posadero,coordinador');
    
    Route::get('/list',[
        'uses'=>'UserController@showAll',
        'as'=>'user.list'  
    ])->middleware('userType:administrador,posadero,coordinador');
    
    Route::get('/my_profile',[
        'uses'=>'UserController@my_profile',
        'as'=>'user.my_profile'
    ])->middleware('autenticado');
    
    Route::get('/profile/{id}',[
        'uses'=>'UserController@profile',
        'as'=>'user.profile'
    ])->middleware('userType:administrador,posadero');
    
    Route::post('/store',[
        'uses'=>'UserController@store',
        'as'=>'user.store'
    ]);
});

//ALERTAS
Route::group(['prefix'=>'alert','middleware'=>['autenticado']],function(){
    
    Route::get('/new',[
        'uses'=>'AlertaController@create',
        'as'=>'alerta.create'
    ]);
    
    Route::post('/store',[
        'uses'=>'AlertaController@store',
        'as'=>'alerta.store'
    ]);
    
    Route::post('/store2',[
        'uses'=>'AlertaController@store2',
        'as'=>'alerta.store2'
    ]);
    
    Route::post('/storeNew',[
        'uses'=>'AlertaController@storeNew',
        'as'=>'alerta.storeNew'
    ]);
    
    Route::get('/list',[
        'uses'=>'AlertaController@showAll',
        'as'=>'alerta.list'
    ])->middleware('userType:administrador,posadero,coordinador');
    
    Route::get('/my_list',[
        'uses'=>'AlertaController@misAlertas',
        'as'=>'alerta.my_list'
    ]);
    
    Route::get('/map',[
        'uses'=>'AlertaController@showMap',
        'as'=>'alerta.showMap'
    ])->middleware('userType:administrador,posadero,coordinador');
    
    Route::get('/destroy/{id}',[
        'uses'=>'AlertaController@destroy',
        'as'=>'alerta.destroy'
    ])->middleware('userType:administrador,posadero,coordinador');
});


//INSTITUCIONES
Route::get('/institucion/box/{id}', 'InstitucionController@getBox')->name('boxInstitucion')->middleware('userType:administrador,posadero,coordinador');

Route::group(['prefix'=>'institucion'],function(){
    
    Route::post('/store',[
        'uses'=>'InstitucionController@store',
        'as'=>'institucion.store'
    ]);
    
    Route::get('/list',[
        'uses'=>'InstitucionController@showAll',
        'as'=>'institucion.list'
    ]);

    Route::post('/updateImage',[
        'uses'=>'InstitucionController@updateImage',
        'as'=>'institucion.updateImage',
    ])->middleware('admin');

    Route::post('/update',[
        'uses'=>'InstitucionController@update',
        'as'=>'institucion.update',
    ])->middleware('admin');

    Route::post('/updateDireccion',[
        'uses'=>'InstitucionController@updateDireccion',
        'as'=>'institucion.updateDireccion',
    ])->middleware('admin');

    Route::get('/ficha/{id}',[
        'uses'=>'InstitucionController@show',
        'as'=>'institucion.ficha'
    ]); //*M editarInstitucion(id)

    Route::get('/muro/{id?}',[
        'uses'=>'InstitucionController@showMuro',
        'as'=>'institucion.muro'
    ]); //*M verInstitucion(id)

});

//COMUNIDADES
Route::group(['prefix'=>'comunidad'],function(){
    
    Route::post('/store',[
        'uses'=>'ComunidadController@store',
        'as'=>'comunidad.store'
    ])->middleware('userType:administrador,posadero');
    
    Route::get('/list',[
        'uses'=>'ComunidadController@showAll',
        'as'=>'comunidad.list'
    ])->middleware('userType:administrador,posadero');
    
    Route::get('/destroy/{id}',[
        'uses'=>'ComunidadController@destroy',
        'as'=>'comunidad.destroy'
    ])->middleware('userType:administrador,posadero');
    
    Route::post('/update',[
        'uses'=>'ComunidadController@update',
        'as'=>'comunidad.update',
    ])->middleware('userType:administrador,posadero,coordinador');
    
    Route::get('/ficha/{id}',[
        'uses'=>'ComunidadController@show',
        'as'=>'comunidad.ficha'
    ]); //*M editarComunidad(id)
    
    Route::get('/muro/{id}',[
        'uses'=>'ComunidadController@showMuro',
        'as'=>'comunidad.muro'
    ]); //*M verComunidad(id)
    
    //SOLICITUDES DE ADHESION A COMUNIDAD
    
    Route::post('/enviarSolicitud',[
        'uses'=>'ComunidadController@enviarSolicitud',
        'as'=>'comunidad.enviarSolicitud',
    ])->middleware('autenticado');
    
    Route::post('/descartarSolicitud',[
        'uses'=>'ComunidadController@descartarSolicitud',
        'as'=>'comunidad.descartarSolicitud',
    ])->middleware('userType:administrador,posadero,coordinador');
    
    Route::post('/aprobarSolicitud',[
        'uses'=>'ComunidadController@aprobarSolicitud',
        'as'=>'comunidad.aprobarSolicitud',
    ])->middleware('userType:administrador,posadero,coordinador');
    
    Route::post('/storeMensaje',[
        'uses'=>'ComunidadController@storeMensaje',
        'as'=>'comunidad.storeMensaje',
    ])->middleware('autenticado');
});


//NECESIDADES
Route::group(['prefix'=>'necesidad'],function(){
    
    Route::get('/list',[
        'uses'=>'NecesidadesController@list',
        'as'=>'necesidad.list'
    ])->middleware('autenticado');
    
    Route::get('/public',[
        'uses'=>'NecesidadesController@public_list',
        'as'=>'necesidad.public'
    ])->middleware('autenticado');
    
    Route::post('/donate',[
        'uses'=>'NecesidadesController@nueva_donacion',
        'as'=>'necesidad.donate'
    ])->middleware('autenticado');
});

//REPORTES-BUSQUEDA
Route::group(['prefix'=>'report','middleware'=>['admin']],function(){
    
    Route::get('/search',[
        'uses'=>'ReportController@showSearch',
        'as'=>'report.show'
    ]);
    
    Route::post('/search',[
        'uses'=>'ReportController@search',
        'as'=>'report.search'
    ]);
});

//ASISTIDOS
Route::group(['prefix'=>'asistido'],function(){
    
    Route::get('/newFromAlert/{id}',[
        'uses'=>'AsistidoController@createFromAlert',
        'as'=>'asistido.newFromAlert'
    ])->middleware('userType:administrador,posadero,coordinador,profesional');
    
    Route::get('/new',[
        'uses'=>'AsistidoController@create',
        'as'=>'asistidos.nuevo'
    ])->middleware('userType:administrador,posadero,coordinador,profesional');
    
    Route::post('/store/{alerta_id}',[
        'uses'=>'AsistidoController@store',
        'as'=>'asistido.store',
    ])->middleware('userType:administrador,posadero,coordinador,profesional');
    
    Route::post('/storeNew',[
        'uses'=>'AsistidoController@storeNew',
        'as'=>'asistido.storeNew',
    ])->middleware('userType:administrador,posadero,coordinador,profesional');
    
    Route::post('/updateImage',[
        'uses'=>'AsistidoController@updateImage',
        'as'=>'asistido.updateImage',
    ])->middleware('userType:administrador,posadero,coordinador,profesional');
    
    Route::post('/agregarComunidad',[
        'uses'=>'AsistidoController@agregarComunidad',
        'as'=>'asistido.agregarComunidad',
    ])->middleware('admin');
    
    Route::post('/verificarDocumentoExistente',[
        'uses'=>'AsistidoController@verificarDocumentoExistente',
        'as'=>'asistido.verificarDocumentoExistente',
    ])->middleware('userType:administrador,posadero,coordinador,profesional');
    
    Route::get('/list',[
        'uses'=>'AsistidoController@showAll',
        'as'=>'asistido.list'
    ])->middleware('userType:administrador,posadero,coordinador,profesional');
    
    Route::get('/busqueda',[
        'uses'=>'AsistidoController@busqueda',
        'as'=>'asistido.busqueda'
    ])->middleware('userType:administrador,posadero,coordinador,profesional');
    
    Route::get('/show/{id}',[
        'uses'=>'AsistidoController@show',
        'as'=>'asistido.show'
    ])->middleware('userType:administrador,coordinador,posadero,profesional');
    
    Route::get('/show2/{id}',[
        'uses'=>'AsistidoController@show2',
        'as'=>'asistido.show2'
    ])->middleware('userType:administrador,coordinador,posadero,profesional');
});

//CONSULTAS/INTERACCIONES
Route::group(['prefix'=>'consultas','middleware'=>'userType:administrador,coordinador,posadero,profesional'],function(){

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
Route::group(['prefix'=>'fichaDatosPersonales','middleware'=>'userType:administrador,coordinador,posadero,profesional'],function(){

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
Route::group(['prefix'=>'fichaAdicciones','middleware'=>'userType:administrador,coordinador,posadero,profesional'],function(){
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
Route::group(['prefix'=>'fichaFamiliaAmigos' ,'middleware'=>'userType:administrador,coordinador,posadero,profesional'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaFamiliaAmigosController@create',
        'as'=>'fichaFamiliaAmigos.create',
    ]);
    Route::get('/get/{id}',[
        'uses'=>'FichaFamiliaAmigosController@get',
        'as'=>'fichaFamiliaAmigos.get',
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
Route::group(['prefix'=>'fichaEducacion','middleware'=>'userType:administrador,coordinador,posadero,profesional'],function(){
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
        'uses'=>'FichaEducacionController@destroyEducacion',
        'as'=>'fichaEducacion.destroyEducacion',
    ]);
});

//FICHA LOCALIZACION
Route::group(['prefix'=>'FichaLocalizacion','middleware'=>'userType:administrador,coordinador,posadero,profesional'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaLocalizacionController@create',
        'as'=>'FichaLocalizacion.create',
    ]);
    Route::get('/get/{id}',[
        'uses'=>'FichaLocalizacionController@get',
        'as'=>'fichaLocalizacion.get',
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
Route::group(['prefix'=>'fichaEmpleo','middleware'=>'userType:administrador,coordinador,posadero,profesional'],function(){
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
Route::group(['prefix'=>'fichaLegal','middleware'=>'userType:administrador,coordinador,posadero,profesional'],function(){
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
Route::group(['prefix'=>'fichaNecesidades','middleware'=>'userType:administrador,coordinador,posadero,profesional'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaNecesidadesController@create',
        'as'=>'fichaNecesidades.create',
    ]);
    Route::get('/get/{id}',[
        'uses'=>'FichaNecesidadesController@get',
        'as'=>'fichaNecesidades.get',
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
Route::group(['prefix'=>'fichaAsistenciaSocial','middleware'=>'userType:administrador,coordinador,posadero,profesional'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaAsistenciaSocialController@create',
        'as'=>'fichaAsistenciaSocial.create',
    ]);
    Route::get('/get/{id}',[
        'uses'=>'FichaAsistenciaSocialController@get',
        'as'=>'fichaAsistenciaSocial.get',
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
Route::group(['prefix'=>'fichaDiagnosticoIntegral','middleware'=>'userType:administrador,coordinador,posadero,profesional'],function(){
    Route::get('/create/{id}',[
        'uses'=>'FichaDiagnosticoIntegralController@create',
        'as'=>'fichaDiagnosticoIntegral.create',
    ]);
    Route::get('/get/{id}',[
        'uses'=>'FichaDiagnosticoIntegralController@get',
        'as'=>'fichaDiagnosticoIntegral.get',
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
Route::group(['prefix'=>'fichaSaludMental','middleware'=>'userType:administrador,coordinador,posadero,profesional'],function(){
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
Route::group(['prefix'=>'fichaMedica','middleware'=>'userType:administrador,coordinador,posadero,profesional'],function(){
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