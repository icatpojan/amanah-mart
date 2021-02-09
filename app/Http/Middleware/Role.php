<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
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
        $user = Auth::user();
        if ($user->role_id == 1) {
            return $next($request);
        } elseif ($user->role_id == 4) {
            return $next($request);
        } else{
            return redirect('home');
        }

        return $next($request);
    }
}
