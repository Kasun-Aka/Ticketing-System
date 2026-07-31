<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
        {
            $user = $request->user();
        
            // 1. Check if user exists (is logged in)
            // 2. Check if user's role is allowed
            if (!$user || !in_array($user->role, $roles)) {
                return response()->json([
                    'error' => 'Unauthorized access. Please log in with appropriate permissions.'
                ], 403);
            }
        
            return $next($request);
        }
}