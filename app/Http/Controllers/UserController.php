<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Negocio;
use App\User;
use Hash;

class ClientesController extends Controller
{
    public function administradores(){
        return view('superusuario.administradores');
    }

    public function storeAdmin(Request $request){
        $this->validate($request, [            
            'nombre' => 'required',
            'email' => 'required',
            'negocio' => 'required',                                        
        ]);

        
        try{
            $negocio = Negocio::create([
                'descripcion' => $request->negocio
            ]);

            if($negocio){
                $password = str_random(8);
                $user = User::Create([
                    'tipouser_id' => 1,
                    'name' => $request->nombre,
                    'email' => $request->email,
                    'password' => Hash::make($password),
                    'negocio_id' => $negocio->id
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
