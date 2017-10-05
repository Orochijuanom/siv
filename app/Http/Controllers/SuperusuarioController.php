<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Negocio;

class SuperusuarioController extends Controller
{
    public function getNegocios(){
        
        $negocios = Negocio::with('users')->FilterPaginateOrder();

        return response(['negocios' => $negocios], 200);

    }
}
