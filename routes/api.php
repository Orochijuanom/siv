<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'negocio', 'middleware' => 'auth:api'], function () {  

    Route::get('/get_oportunidades_abiertas','NegocioController@get_oportunidades_abiertas');
    

});
Route::get('/negocios', 'SuperusuarioController@getNegocios');

Route::post('/negocios', 'SuperusuarioController@storeNegocios');

Route::post('/administrador', 'UserController@storeAdministrador');

Route::get('/empresas', 'EmpresasController@getEmpresas');

Route::post('/empresas', 'EmpresasController@storeEmpresas');

Route::get('/proveedores', 'NegocioController@getProveedores');

Route::post('/proveedores', 'NegocioController@storeProveedores');

Route::get('/categorias', 'NegocioController@getCategorias');

Route::get('/productos', 'NegocioController@getProductos');

Route::post('/productos', 'NegocioController@storeProductos');

Route::post('/oportunidades', 'OportunidadesController@storeOportunidades');

Route::get('/usuarios/negocio/{id}', 'UserController@userList');

Route::get('/tipousers', function () {
    $tipousers = App\Tipouser::where('id', '<>', '1')->get();

    return response(['tipousers' => $tipousers], 200);

});

Route::get('/monedas', function () {
    $monedas = App\Moneda::all();

    return response(['monedas' => $monedas], 200);

});

Route::post('/users', 'UserController@storeUser');
