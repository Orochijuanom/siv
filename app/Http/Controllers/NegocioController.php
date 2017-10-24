<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
