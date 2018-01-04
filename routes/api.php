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

Route::group(['middleware' => 'auth:api'], function () {
    
    //retorna el listado de usuarios del negocio
    Route::get('/usuarios', 'UserController@userList'); 

    //permite crear usuarios relacionados a un negocio
    Route::post('/users', 'UserController@storeUser');

    //permite editar los datos de los usuarios del negocio
    Route::post('/updateUsers', 'UserController@updateUsers');

    //retorna el listado de empresas
    Route::get('/empresas', 'NegocioController@getEmpresas');

    //permite crear empresas en un negocio
    Route::post('/empresas', 'NegocioController@storeEmpresas');

    //permite editar una empresa
    Route::post('/updateEmpresas', 'NegocioController@updateEmpresas');

    //retorna el listado de productos por negocio
    Route::get('/productos', 'NegocioController@getProductos');

    //permite crear los productos para un negocio
    Route::post('/productos', 'NegocioController@storeProductos');

    //permite editar un producto
    Route::post('/updateProductos', 'NegocioController@updateProductos');

    //Route::get('/get_oportunidades_abiertas','NegocioController@get_oportunidades_abiertas');
});

Route::post('/crearCotizacion','OportunidadesController@crearCotizacion');

Route::get('/negocios', 'SuperusuarioController@getNegocios');

Route::post('/negocios', 'SuperusuarioController@storeNegocios');

Route::post('/administrador', 'UserController@storeAdministrador');

Route::get('/proveedores', 'NegocioController@getProveedores');

Route::post('/proveedores', 'NegocioController@storeProveedores');

Route::post('/updateProveedores', 'NegocioController@updateProveedores');

Route::post('/getStockRela', 'NegocioController@getStockRela');

Route::get('/categorias', 'NegocioController@getCategorias');

Route::post('/oportunidades', 'OportunidadesController@storeOportunidades');



Route::get('/get_oportunidades_abiertas','NegocioController@getOportunidadesAbiertas');




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
