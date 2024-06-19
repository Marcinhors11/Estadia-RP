<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdministrador
{
    public function handle($request, Closure $next, $guard = 'administrador')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('repositorio/login');
        }

        return $next($request);
    }
}
