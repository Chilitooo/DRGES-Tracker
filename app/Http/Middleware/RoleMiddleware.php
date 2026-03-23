<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $roles  Pipe- or comma-separated allowed roles (e.g. "admin|staff")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        if (!auth()->check()) {
            abort(403);
        }

        $allowedRoles = explode(",", $roles);

        if (!in_array(auth()->user()->role, $allowedRoles)) {
            abort(403, 'Unauthorized Access.');
        }

        return $next($request);
    }
}
