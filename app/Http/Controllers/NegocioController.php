<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedore;
use App\Producto;
use App\Categoria;

class NegocioController extends Controller
{
    

    public function oportunidades_abiertas(Request $request)
    {
        
    }

    public function oportunidades_cerradas(Request $request)
    {

    }

    public function oportunidades_seguimiento(Request $request)
    {

    }


    public function proveedores(Request $request)
    {
        return view('proveedores.index');
    }

    public function getProveedores()
    {        
        $proveedores = Proveedore::with('negocio')->FilterPaginateOrder();
        return response(['proveedores' => $proveedores], 200);
    }

    public function storeProveedores(Request $request){
        $this->validate($request, [            
            'nombre' => 'required',
            'email' => 'required',
            'empresa' => 'required',
            'telefono' => 'required',
            'nit' => 'required', 

        ]);
        
        try{
            $nit = $request->nit."-".$request->dig;
            $proveedores = Proveedore::Create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'negocio_id' => 1,
                'telefono' => $request->telefono,
                'empresa' => $request->empresa,
                'nit' => $nit
            ]);

            return response(['data' => 'exito'], 200);
        }catch(\Exception $e){
            return response(['data' => $e->getMessage()], 401); 
        }
    }

    public function getCategorias()
    {        
        $categoria = Categoria::get();
        return response(['categoria' => $categoria], 200);
    }

    public function productos(Request $request)
    {
        return view('negocio.productos');
    }

    public function getProductos()
    {        
        $productos = Producto::with('negocio')->with('categoria')->FilterPaginateOrder();
        return response(['productos' => $productos], 200);
    }

    public function storeProductos(Request $request){
        $this->validate($request, [            
            'descripcion' => 'required',
            'categoria_id' => 'required',
            'estado' => 'required', 

        ]);
        
        try{
            $nit = $request->nit."-".$request->dig;
            $proveedores = Producto::Create([
                'descripcion' => $request->descripcion,
                'categoria_id' => $request->categoria_id,
                'negocio_id' => 1,
                'estado' => $request->estado
            ]);

            return response(['data' => 'exito'], 200);
        }catch(\Exception $e){
            return response(['data' => $e->getMessage()], 401); 
        }
    }
}