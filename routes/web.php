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

Route::get('/', function () {
    return view('welcome');
});

//Administrador
Route::middleware(['auth','admin'])->group(function () {
	
	//Categoria
	Route::get('/administrador/categorias','CategoryController@index');
	Route::get('/administrador/categorias/create','CategoryController@create');
	Route::post('/administrador/categorias','CategoryController@store');
	Route::get('/administrador/categorias/{categoria}/edit','CategoryController@edit');
	Route::post('/administrador/categorias/{categoria}/edit','CategoryController@update');
	Route::delete('/administrador/categorias/{id}','CategoryController@destroy');

	//Servicio
	Route::get('/administrador/servicios','ServiceController@index');
	Route::get('/administrador/servicios/create','ServiceController@create');
	Route::post('/administrador/servicios','ServiceController@store');
	Route::get('/administrador/servicios/{servicio}/edit','ServiceController@edit');
	Route::post('/administrador/servicios/{servicio}/edit','ServiceController@update');
	Route::delete('/administrador/servicios/{id}','ServiceController@destroy');

	//Region
	Route::get('/administrador/regiones','RegionController@index');
	Route::get('/administrador/regiones/create','RegionController@create');
	Route::post('/administrador/regiones','RegionController@store');
	Route::get('/administrador/regiones/{region}/edit','RegionController@edit');
	Route::post('/administrador/regiones/{region}/edit','RegionController@update');
	Route::delete('/administrador/regiones/{id}','RegionController@destroy');

	//Comuna
	Route::get('/administrador/comunas','CommuneController@index');
	Route::get('/administrador/comunas/create','CommuneController@create');
	Route::post('/administrador/comunas','CommuneController@store');
	Route::get('/administrador/comunas/{comuna}/edit','CommuneController@edit');
	Route::post('/administrador/comunas/{comuna}/edit','CommuneController@update');
	Route::delete('/administrador/comunas/{id}','CommuneController@destroy');
});

//Empresa
Route::middleware(['auth','empresa'])->group(function () {
	//Perfil
	Route::get('/empresa/perfil','CompanyController@index');
	Route::get('/empresa/perfil/{empresa}/edit','CompanyController@edit');
	Route::post('/empresa/perfil/{empresa}/edit','CompanyController@update');
	Route::get('/empresa/perfil/createService','CompanyController@createService');
	Route::post('/empresa/perfil/createService','CompanyController@storeService');
	Route::delete('/empresa/perfil/{id}','CompanyController@destroy');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
