<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Response;

class checkVendedor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->tipouser_id != 3) {
                dd('hola');
                return response::view('errors/401',array() ,401);
            }
        }else{
            return redirect()->guest('home');
        }

        return $next($request);
    }
}
