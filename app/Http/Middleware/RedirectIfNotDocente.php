<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotDocente
{
    public function handle($request, Closure $next, $guard = 'docente')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('repositorio/login');
        }

        return $next($request);
    }
}
