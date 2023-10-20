<?php

namespace App\Http\Middleware;

use Closure;

use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;


class CheckProveedorRole
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->hasRole('Proveedor')) {
            return $next($request);
        }

        return redirect('/')->with('error', 'No tienes acceso a esta página.');
    }
}
