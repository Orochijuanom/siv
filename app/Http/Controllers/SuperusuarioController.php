<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


use App\Negocio;
use App\User;

class SuperusuarioController extends Controller
{
    public function getNegocios(){
        
        $negocios = Negocio::with('users')->FilterPaginateOrder();

        return response(['negocios' => $negocios], 200);

    }

    public function storeNegocios(Request $request){
        $this->validate($request, [
            'negocio' => 'required_without:negocio_id',
            'negocio_id' => 'required_without:negocio',
            'administrador' => 'required',
            'email' => 'required|email'
        ]);

        
        try{

            if($request->negocio_id == ''){
                $negocio = Negocio::create([
                    'descripcion' => $request->negocio
                ]);

                if($negocio){
                    $password = str_random(8);
                    
                    $user = User::create([
                        'name' => $request->administrador,
                        'email' => $request->email,
                        'password' => Hash::make($password),
                        'tipouser_id' => 2,
                        'negocio_id' => $negocio->id,
                        'activo' => 1
                    ]);
                }else{
                    return response(['data' => 'error'], 400);
                }
            }else{
                $negocio_id = $request->negocio_id;

                $password = str_random(8);
                
                $user = User::create([
                    'name' => $request->administrador,
                    'email' => $request->email,
                    'password' => Hash::make($password),
                    'tipouser_id' => 2,
                    'negocio_id' => $negocio_id,
                    'activo' => 1
                ]);
            }

            if($user){
                //aca debo enviar el email
                return response('usuario registrado', 200);  
            }else{
                return response(['data' => 'error'], 400);
            }
            
        }catch (\Exception $e) {
            return response(['data' => 'error'], 400);
        }
    }
}
