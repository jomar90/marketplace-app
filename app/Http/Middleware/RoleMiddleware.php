<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        $user = $request->user();
        if (! $user) {
            abort(403);
        }

        $allowedRoles = explode(',', $roles);
        if (! in_array($user->role, $allowedRoles)) {
            abort(403);
        }

        return $next($request);
    }
}
