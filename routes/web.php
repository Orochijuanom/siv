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
    return redirect('login');
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
        return view('superusuario.negocios');
    });

    Route::get('/administradores', 'UserController@administradores');

    //quitar
});


Route::group(['prefix' => 'negocio', 'middleware' => 'administrador'], function () {

    Route::get('/', function () {
        return view('negocio.usuarios');
    });
    
    Route::get('/empresas', 'EmpresasController@index');
    
    Route::get('/proveedores','NegocioController@proveedores');

    Route::get('/oportunidades/negocio/{id}','OportunidadesController@index'); 

    Route::get('/productos','NegocioController@productos');

    Route::get('/oportunidades/oportunidades', function(){
        return view('negocio.oportunidades');
    });


    Route::get('/oportunidades/abiertas', function(){
        return view('negocio.oportunidades_abiertas');
    });

    Route::get('/oportunidades/vencidas', function(){
        return view('negocio.oportunidades_vencidas');
    });

    Route::get('/oportunidades/cerradas', function(){
        return view('negocio.oportunidades_cerradas');
    });

    Route::get('/oportunidades/seguimiento',function(){
        return view('negocio.oportunidades_seguimiento');
    }); 
});


Route::get('/oportunidades/negocio/{id}/', 'OportunidadesController@index');

