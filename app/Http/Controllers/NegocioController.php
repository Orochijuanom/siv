<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Empresa;
use App\Proveedore;
use App\Producto;
use App\Categoria;
use App\Stock;

class NegocioController extends Controller
{
    

    public function getOportunidadesAbiertas(Request $request)
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
        return view('negocio.proveedores');
    }

    public function getProveedores()
    {        
        $proveedores = Proveedore::with('negocio')->FilterPaginateOrder();
        return response(['proveedores' => $proveedores], 200);
    }

    public function getStockRela(Request $request)
    {     
        $condicion = array("1", "=" , "1");
        if($request->tipo == "Producto"){
            $condicion = array("stocks.producto_id", "=",$request->id);
        }
        if($request->tipo == "Proveedor"){
            $condicion = array("stocks.proveedore_id","=",$request->id);
        }
        $select = "stocks.*";
        if($request->tipo == "Proveedor"){
            $select = "productos.id as id, productos.descripcion";
        }
        if($request->tipo == "Producto"){
            $select = "proveedores.id as id";
        }
        $stock = Stock::join("productos","stocks.producto_id","=","productos.id")->
        join("proveedores","stocks.proveedore_id","=","proveedores.id")->
        where(DB::raw($condicion[0]),$condicion[1],$condicion[2])->select(DB::raw($select))->get();
        return response(['stock' => $stock], 200);
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

            $proveedores = Proveedore::Create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'negocio_id' => "1",
                'telefono' => $request->telefono,
                'empresa' => $request->empresa,
                'nit' => $request->nit
            ]);

            for($i =0;$i < count($request->productos); $i++){
                $stock = Stock::Create([
                    'producto_id' => $request->productos[$i][0],
                    'proveedore_id' => $proveedores->id,
                    'estado' => '1',
                    'valor' => 0,
                    'fecha_entrega' => "2017-01-01",
                    'forma_entrega' => "Casa"
                ]);
            }

            return response(['data' => 'exito'], 200);
        }catch(\Exception $e){
            return response(['data' => $e->getMessage()], 401); 
        }
    }

    public function updateProveedores(Request $request){
        $this->validate($request, [            
            'nombre' => 'required',
            'email' => 'required',
            'empresa' => 'required',
            'telefono' => 'required',
            'nit' => 'required', 
        ]);
        try{
            $proveedoresDatos = [
                'nombre' => $request->nombre,
                'email' => $request->email,
                'negocio_id' => "1",
                'telefono' => $request->telefono,
                'empresa' => $request->empresa,
                'nit' => $request->nit
            ];
            $proveedoresData = Proveedore::updateOrCreate(['id'=> $request->id], $proveedoresDatos);
            //\LogActivity::addToLog('EMPRESA Id:'.$empresaData->id);
            Stock::where('proveedore_id',$request->id)->delete();
            for($i =0;$i < count($request->productos); $i++){
                $producto = Producto::where('id',$request->productos[$i])->first();
                $categoria = Categoria::where('id',$producto->id)->first();
                $stock = Stock::Create([
                    'categoria_id' => $categoria->id,
                    'producto_id' => $request->productos[$i][0],
                    'proveedore_id' => $request->id,
                    'estado' => '1',
                    'valor' => 0,
                    'fecha_entrega' => "2017-01-01",
                    'forma_entrega' => "Casa"
                ]);
            }
            return response(['data' => 'exito'], 200);
        }catch(\Exception $e){
            return response(['data' => $e->getMessage()], 401); 
        }
    }

    public function getCategorias()
    {        
        $categorias = Categoria::all();
        return response(['categorias' => $categorias], 200);
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
            'parte' => 'required',
            'fabricante' => 'required',
            'estado' => 'required',
            'negocio' => 'required' 

        ]);
        
        try{
            $nit = $request->nit."-".$request->dig;
            $productos = Producto::Create([
                'descripcion' => $request->descripcion,
                'categoria_id' => $request->categoria_id,
                'nparte' => $request->parte,
                'fabricante' => $request->fabricante,
                'negocio_id' => $request->negocio,
                'estado' => $request->estado
            ]);

            return response(['data' => 'exito'], 200);
        }catch(\Exception $e){
            return response(['data' => $e->getMessage()], 401); 
        }
    }
    public function updateProductos(Request $request){
        $this->validate($request, [            
            'descripcion' => 'required',
            'id' => 'required',
            'parte' => 'required',
            'fabricante' => 'required',
            'categoria_id' => 'required',
            'estado' => 'required',
        ]);
        try{
            $productosDatos = [
                'descripcion' => $request->descripcion,
                'nparte' => $request->parte,
                'fabricante' => $request->fabricante,
                'categoria_id' => $request->categoria_id,
                'estado' => $request->estado,
            ];
            $productosData = Producto::updateOrCreate(['id'=> $request->id], $productosDatos);
            //\LogActivity::addToLog('EMPRESA Id:'.$empresaData->id);
            return response(['data' => 'exito'], 200);
        }catch(\Exception $e){
            return response(['data' => $e->getMessage()], 401); 
        }
    }

    public function getEmpresas(){
        
        $empresas = Empresa::with('negocio')->FilterPaginateOrder();

        return response(['empresas' => $empresas], 200);

    }

    public function storeEmpresas(Request $request){
        $this->validate($request, [            
            'descripcion' => 'required',
            'logo' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'negocio' => 'required',
            'nit' => 'required' 

        ]);
        try{

            $empresas = Empresa::Create([
                'descripcion' => $request->descripcion,
                'email' => $request->email,
                'negocio_id' => $request->negocio,
                'logo' => $request->logo,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'nit' => $request->nit
            ]);
            return response(['data' => 'exito'], 200);
        }catch(\Exception $e){
            return response(['data' => $e->getMessage()], 401); 
        }
    }

    public function updateEmpresas(Request $request){
        $this->validate($request, [            
            'descripcion' => 'required',
            'logo' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'nit' => 'required' 

        ]);
        try{
            $empresasDatos = [
                'descripcion' => $request->descripcion,
                'email' => $request->email,
                'logo' => $request->logo,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'nit' => $request->nit
            ];
            $empresaData = Empresa::updateOrCreate(['id'=> $request->id], $empresasDatos);
            //\LogActivity::addToLog('EMPRESA Id:'.$empresaData->id);
            return response(['data' => 'exito'], 200);
        }catch(\Exception $e){
            return response(['data' => $e->getMessage()], 401); 
        }
    }
}
