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

Auth::routes();

Route::get('/home', 'HomeController@index');

//superusuario tipouser_id=1 administador tipouser_id=2 vendedor tipouser_id=3
Route::group(['prefix' => 'superusuario', 'middleware' => 'superusuario'], function () {
   
    Route::get('/negocios', function () {
        return view('superusuario.negocios');
    });

    //quitar

    Route::get('/', function () {
        return view('superusuario.administradores');
    });

    Route::get('/administradores', 'UserController@administradores');

    //quitar
});


Route::group(['prefix' => 'negocio'], function () {
    
    Route::get('/empresas', 'EmpresasController@index');
    
    Route::get('/proveedores','ProveedoresController@index');
});

