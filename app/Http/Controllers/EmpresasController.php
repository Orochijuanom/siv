<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Negocio;

class EmpresasController extends Controller
{
    public function index(Request $request){
        return view('negocio.empresas');
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

        ]);

        
        try{


                $nit = $request->nit."-".$request->dig;
                $empresas = Empresa::Create([
                    'descripcion' => $request->descripcion,
                    'email' => $request->email,
                    'negocio_id' => 1,
                    'logo' => $request->logo,
                    'direccion' => $request->direccion,
                    'telefono' => $request->telefono,
                    'nit' => $nit
                ]);

                return response(['data' => 'exito'], 200);
        }catch(\Exception $e){
            return response(['data' => $e->getMessage()], 401); 
        }
    }
}
