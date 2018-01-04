<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Negocio;
use App\User;
use Auth;
use Hash;

class UserController extends Controller
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

    public function userList(){
        $usuarios = User::where('negocio_id', Auth::user()->negocio_id)->FilterPaginateOrder();

        return response(['usuarios' => $usuarios], 200);
    }

    public function storeUser(Request $request){
        $this->validate($request, [            
            'nombre' => 'required',
            'email' => 'required|email',
            'tipousuario' => 'required',                                         
        ]);

        
        try{

            
            $password = str_random(8);
            $user = User::Create([
                'tipouser_id' => $request->tipousuario,
                'name' => $request->nombre,
                'email' => $request->email,
                'password' => Hash::make($password),
                'negocio_id' => Auth::user()->negocio_id
            ]);

            return response(['data' => 'exito'], 200);
            
        }catch(\Exception $e){
            return response(['data' => $e->getMessage()], 401); 
        }
    }

    public function updateUsers(Request $request){
        $this->validate($request, [            
            'tipousuario' => 'required',
            'nombre' => 'required',
            'email' => 'required',

        ]);
        try{
    
            $usersDatos = [
                'tipouser_id' => $request->tipousuario,
                'name' => $request->nombre,
                'email' => $request->email,
            ];
            $UserData = User::updateOrCreate(['id'=> $request->id], $usersDatos);
            //\LogActivity::addToLog('EMPRESA Id:'.$empresaData->id);
            return response(['data' => 'exito'], 200);
        }catch(\Exception $e){
            return response(['data' => $e->getMessage()], 401); 
        }
    }
}
