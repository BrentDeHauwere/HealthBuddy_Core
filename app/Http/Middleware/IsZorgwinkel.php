<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use \App\User;
use Mockery\CountValidator\Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class IsZorgwinkel
{
    /**
     * Check if an incoming request to the website has the correct role, if not
     * redirect that user to the login page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->has('loginform')){
            try {
            // check if the
                $role = User::where('email', '=', $request->email)->firstOrFail()->role;
                if($role != 'Zorgwinkel') {
                    return Redirect::to('login')->withInput($request->except('password'));
                }
                return $next($request);

            }catch(ModelNotFoundException $x){
                return $next($request);
            }
        }
        else{
            return $next($request);
        }
    }
}
