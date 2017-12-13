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

Route::middleware(['auth','admin'])->group(function () {

	Route::get('/administrador/categorias','CategoryController@index');
	Route::get('/administrador/categorias/create','CategoryController@create');
	Route::post('/administrador/categorias','CategoryController@store');
	Route::get('/administrador/categorias/{categoria}/edit','CategoryController@edit');
	Route::post('/administrador/categorias/{categoria}/edit','CategoryController@update');
	Route::delete('/administrador/categorias/{id}','CategoryController@destroy');

	Route::get('/administrador/servicios','ServiceController@index');
	Route::get('/administrador/servicios/create','ServiceController@create');
	Route::post('/administrador/servicios','ServiceController@store');
	Route::get('/administrador/servicios/{servicio}/edit','ServiceController@edit');
	Route::post('/administrador/servicios/{servicio}/edit','ServiceController@update');
	Route::delete('/administrador/servicios/{id}','ServiceController@destroy');

	Route::get('/administrador/regiones','RegionController@index');
	Route::get('/administrador/regiones/create','RegionController@create');
	// Route::post('/administrador/regiones','RegionController@store');
	// Route::get('/administrador/regiones/{region}/edit','RegionController@edit');
	// Route::post('/administrador/regiones/{region}/edit','RegionController@update');
	// Route::delete('/administrador/regiones/{id}','RegionController@destroy');

});	

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
