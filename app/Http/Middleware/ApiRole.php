<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ApiRole
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
        if ($user->role_id == 5) {
            return redirect('admin/dashboard');
        } elseif ($user->role_id == 1) {
            return redirect('kasir/dashboard');
        } else{
            return redirect('staff/dashboard');
        }

        return $next($request);
    }
}
