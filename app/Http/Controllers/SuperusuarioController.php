<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Negocio;

class SuperusuarioController extends Controller
{
    public function getNegocios(){
        $negocios = Negocio::FilterPaginateOrder();

    }
}
