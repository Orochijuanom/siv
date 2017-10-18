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

Route::get('/negocios', 'SuperusuarioController@getNegocios');

Route::post('/negocios', 'SuperusuarioController@storeNegocios');

Route::post('/administrador', 'UserController@storeAdministrador');

Route::get('/proveedores', 'ProveedoresController@getProveedores');

Route::post('/proveedores', 'ProveedoresController@storeProveedores');

Route::post('/oportunidades', 'OportunidadesController@storeOportunidades');

Route::get('/usuarios/negocio/{id}', 'UserController@userList');

Route::get('/tipousers', function () {
    $tipousers = App\Tipouser::where('id', '<>', '1')->get();

    return response(['tipousers' => $tipousers], 200);

});

Route::post('/users', 'UserController@storeUser');
