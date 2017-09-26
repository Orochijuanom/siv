<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Response;

class checkAdministrador
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
            if (Auth::user()->tipouser_id != 1) {
                return response::view('errors/401',array() ,401);
            }
        }else{
            return redirect()->guest('login');
        }

        return $next($request);
    }
}
