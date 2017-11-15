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

Route::get('/empresas', 'NegocioController@getEmpresas');

Route::post('/empresas', 'NegocioController@storeEmpresas');

Route::post('/updateEmpresas', 'NegocioController@updateEmpresas');

Route::get('/proveedores', 'NegocioController@getProveedores');

Route::post('/proveedores', 'NegocioController@storeProveedores');

Route::get('/categorias', 'NegocioController@getCategorias');

Route::get('/productos', 'NegocioController@getProductos');

Route::post('/productos', 'NegocioController@storeProductos');

Route::post('/updateProductos', 'NegocioController@updateProductos');

Route::post('/oportunidades', 'OportunidadesController@storeOportunidades');

Route::get('/usuarios/negocio/{id}', 'UserController@userList');

Route::post('/updateUsers', 'UserController@updateUsers');


Route::get('/tipousers', function () {
    $tipousers = App\Tipouser::where('id', '<>', '1')->get();

    return response(['tipousers' => $tipousers], 200);

});

Route::get('/prductosselect', function () {
    $productos = App\Producto::all();
    return response(['productos' => $productos], 200);
});

Route::get('/search_producto/{query?}', function($query = null) {
    if($query == null){
          $productos = null;
    }else{
          $productos = App\Producto::with('categoria')->where('estado', 1)->where('descripcion', 'like', '%'.$query.'%')->get();
    
    }
    return response(['productos' => $productos], 200);

});

Route::get('/monedas', function () {
    $monedas = App\Moneda::all();

    return response(['monedas' => $monedas], 200);

});

Route::post('/users', 'UserController@storeUser');
