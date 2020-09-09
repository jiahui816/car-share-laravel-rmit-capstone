<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Member
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

        if (!Auth::check()) {
            return redirect()->route('login');
        }elseif (Auth::user()->role == 2) {
            return redirect('/cars');
        }

        return $next($request);
    }
}
