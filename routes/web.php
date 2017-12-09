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

Route::get('/administrador/categorias','CategoryController@index');//Listado de Categorias
Route::get('/administrador/categorias/create','CategoryController@create');//Crear Categoria
Route::post('/administrador/categorias','CategoryController@store');//Almacenar Categoria
Route::get('/administrador/categorias/{categoria}/edit','CategoryController@edit'); //Formulario para editar
Route::post('/administrador/categorias/{categoria}/edit','CategoryController@update');
Route::delete('/administrador/categorias/{id}','CategoryController@destroy');

Route::get('/administrador/servicios','ServiceController@index');//Listado de Servicios
Route::get('/administrador/servicios/create','ServiceController@create');//Crear Servicio
