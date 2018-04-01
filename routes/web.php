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


//Inicio
Route::middleware(['inicio'])->group(function () {
	Route::get('/','WelcomeController@inicio');
});


//Administrador
Route::middleware(['auth','admin'])->group(function () {
	
	//Categoria 
	Route::get('/administrador/categorias','CategoryController@listarCategorias');
	Route::get('/administrador/categorias/create','CategoryController@crearCategoria');
	Route::post('/administrador/categorias','CategoryController@guardarCategoria');
	Route::get('/administrador/categorias/{categoria}/edit','CategoryController@editarCategoria');
	Route::post('/administrador/categorias/{categoria}/edit','CategoryController@actualizarCategoria');
	Route::delete('/administrador/categorias/{id}','CategoryController@eliminarCategoria');

	//Servicio
	Route::get('/administrador/servicios','ServiceController@listarServicios');
	Route::get('/administrador/servicios/create','ServiceController@crearServicio');
	Route::post('/administrador/servicios','ServiceController@guardarServicio');
	Route::get('/administrador/servicios/{servicio}/edit','ServiceController@editarServicio');
	Route::post('/administrador/servicios/{servicio}/edit','ServiceController@actualizarServicio');
	Route::delete('/administrador/servicios/{id}','ServiceController@eliminarServicio');

	//Region
	Route::get('/administrador/regiones','RegionController@listarRegiones');
	Route::get('/administrador/regiones/create','RegionController@crearRegion');
	Route::post('/administrador/regiones','RegionController@guardarRegion');
	Route::get('/administrador/regiones/{region}/edit','RegionController@editarRegion');
	Route::post('/administrador/regiones/{region}/edit','RegionController@actualizarRegion');
	Route::delete('/administrador/regiones/{id}','RegionController@eliminarRegion');

	//Comuna
	Route::get('/administrador/comunas','CommuneController@listarComunas');
	Route::get('/administrador/comunas/create','CommuneController@crearComuna');
	Route::post('/administrador/comunas','CommuneController@guardarComuna');
	Route::get('/administrador/comunas/{comuna}/edit','CommuneController@editarComuna');
	Route::post('/administrador/comunas/{comuna}/edit','CommuneController@actualizarComuna');
	Route::delete('/administrador/comunas/{id}','CommuneController@eliminarComuna');

	//Empresa
	Route::get('/administrador/empresas','CompanyController@listarEmpresasAdmin');
	Route::get('/administrador/empresas/{usuario}/edit','UserController@editarEstadoEmpresa');
	Route::post('administrador/empresas/{usuario}/edit','UserController@actualizarEstadoEmpresa');

	//Resumen
	Route::get('/administrador/resumen','ReservationController@resumenEmpresasAdmin');

	//Validar
	Route::get('/administrador/empresas/{usuario}/verificar','UserController@verificar');
	Route::post('administrador/empresas/{usuario}/verificar','UserController@mofificaVerificar');
});

//Empresa
Route::middleware(['auth','empresa'])->group(function () {

	//Perfil
	Route::get('/empresa/perfil','CompanyController@index');
	Route::get('/empresa/perfil/{empresa}/edit','CompanyController@edit');
	Route::post('/empresa/perfil/{empresa}/edit','CompanyController@update');

	Route::get('/empresa/perfil/createService','ServiceController@createService');
	Route::post('/empresa/perfil/createService','ServiceController@storeService');
	Route::delete('/empresa/perfil/{id}','ServiceController@destroyService');

	Route::get('/empresa/perfil/createCommune','CommuneController@createCommune');
	Route::post('/empresa/perfil/createCommune','CommuneController@storeCommune');
	Route::delete('/empresa/perfil/{id}/{comuna}','CommuneController@destroyCommune');

	Route::get('/empresa/perfil/createGalery','GaleryController@createGalery');
	Route::post('/empresa/perfil/createGalery','GaleryController@storeGalery');
	Route::delete('/empresa/perfil/{id}/{foto}/{fotos}','GaleryController@destroyGalery');
	Route::get('/empresa/perfil/createGalery','GaleryController@createGalery');
	
	Route::get('/empresa/validar/create','DocumentController@create');
	Route::post('/empresa/validar/create','DocumentController@store');

	//trabajadores
	Route::get('/empresa/trabajador','EmployeController@index');
	Route::get('/empresa/trabajador/create','UserController@create');
	Route::post('/empresa/trabajador','UserController@store');
	Route::get('/empresa/trabajador/{usuario}/edit','UserController@editar');
	Route::post('/empresa/trabajador/{usuario}/edit','UserController@actualizar');
	Route::delete('/empresa/trabajador/{id}','EmployeController@destroy');

	//Solicitud
	Route::get('/empresa/solicitud','OrderController@inicio');
	Route::get('/empresa/solicitud/{id}/edit','OrderController@edit');
	Route::post('empresa/solicitud/{id}/edit','OrderController@update');

	//Reserva
	Route::get('/empresa/reserva','ReservationController@index');
	
	//Asignar
	Route::get('/empresa/asignar','ReservationController@asignar');
	Route::get('/empresa/asignar/{id}/edit','ReservationController@edit');
	Route::post('empresa/asignar/{id}/edit','ReservationController@update');

	//Resumen
	Route::get('/empresa/resumen-reserva','ReservationController@resumenEmpresa');
	Route::get('/empresa/resumen-trabajador','ReservationController@resumenTrabajadores');
	
});

//Cliente
Route::middleware(['auth','cliente'])->group(function () {

	//Perfil
	Route::get('/cliente/perfil','ClientController@index');
	Route::get('/cliente/perfil/{cliente}/edit','ClientController@edit');
	Route::post('/cliente/perfil/{cliente}/edit','ClientController@update');

	//Buscar
	Route::get('/cliente/buscar','ClientController@buscar');

	//Solicitud
	Route::get('/cliente/solicitud','OrderController@index');
	Route::get('/cliente/solicitud/{empresa}/show','ClientController@show');
	Route::get('/cliente/solicitud/{empresa}/cotizar','OrderController@create');
	Route::post('/cliente/solicitud/{empresa}/cotizar','OrderController@store');
	Route::get('/cliente/solicitud/{id}/edit','OrderController@editar');
	Route::post('cliente/solicitud/{id}/edit','OrderController@actualizar');

	//Reserva
	Route::get('/cliente/reserva','ReservationController@inicio');

	//Calificar
	Route::get('/cliente/calificar','ClientController@calificaciones');
	Route::get('/cliente/calificar/{id}/calificar','ClientController@calificar');
	Route::post('cliente/calificar/{id}/calificar','ClientController@guardarCalificacion');

	
});

//Trabajador
Route::middleware(['auth','trabajador'])->group(function () {

	//Perfil
	Route::get('/trabajador/perfil','EmployeController@inicio');
	Route::get('/trabajador/perfil/{trabajador}/edit','EmployeController@edit');
	Route::post('/trabajador/perfil/{trabajador}/edit','EmployeController@update');

	//Reservas
	Route::get('/trabajador/reserva','ReservationController@trabajos');

	//Mapa
	Route::get('/trabajador/reserva/{orden}/mapa','ReservationController@mapa');
	
});


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
