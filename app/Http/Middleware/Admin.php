<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        //create admin file in config folder
        //check if user is admin
        if(auth()->check()){
            if (auth()->user()->isAdmin()){
                return $next($request);
            }else{
                session()->flash('error','You Are Not Admin');
                return redirect('/');
            }
        }else{
            return redirect('/');
        }

    }
}
