<?php

namespace App\Http\Middleware;

use Closure;

class CheckJK
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
        if(auth()->user()->user_type == "JK") {
            return $next($request);
        } else {
            abort(403, 'Akses Gagal');
        }
        
    }
}
