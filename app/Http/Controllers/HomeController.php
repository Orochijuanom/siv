<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->tipouser_id == 1) {
                return redirect('/superusuario');
            }elseif(Auth::user()->tipouser_id == 2){
                return redirect('/negocio'); 
            }elseif(Auth::user()->tipouser_id == 3){
                return redirect('/vendedor');
            }else{
                return Response::view('errors.missing',array() ,401);
            } 
        }else{
            return redirect()->guest('/');
        }
    }
}
