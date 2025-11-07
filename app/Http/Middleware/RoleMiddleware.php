<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param mixed ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Check if user is logged in and has one of the allowed roles
        if (!$user || !in_array($user->role, $roles)) {
            abort(403, 'Unauthorized'); // Or redirect to '/home' for a friendly message
        }

        return $next($request);
    }
}
