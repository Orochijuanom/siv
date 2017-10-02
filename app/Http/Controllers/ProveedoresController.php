<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedore;
use App\Negocio;

class ProveedoresController extends Controller
{
    public function index(Request $request){
        return view('proveedores.index');
    }

    public function storeProveedores(Request $request){
        $this->validate($request, [            
            'nombre' => 'required',
            'email' => 'required',
            'negocio' => 'required', 
            'empresa' => 'required',
            'telefono' => 'required',
            'nit' => 'required', 

        ]);

        
        try{
            $negocio = Negocio::create([
                'descripcion' => $request->negocio
            ]);

            if($negocio){
                $nit = $request->nit."-".$request->dig;
                $proveedores = Proveedore::Create([
                    'nombre' => $request->nombre,
                    'email' => $request->email,
                    'negocio_id' => $negocio->id,
                    'telefono' => $request->telefono,
                    'empresa' => $request->empresa,
                    'nit' => $nit
                ]);

                return response(['data' => 'exito'], 200);
            }else{
                return response(['data' => 'error'], 401);
            }
        }catch(\Exception $e){
            return response(['data' => $e->getMessage()], 401); 
        }
    }
}
