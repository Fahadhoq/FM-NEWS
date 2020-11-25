<?php


namespace App\Http\Middleware;

use Auth;

use Closure;

class UserMiddleware
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
         $role = Auth::user(); //Obtenemos el rol del usuario

     if($role == null){

        return redirect('/login');
    }
        return $next($request);

    }
}
