<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthHeader
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('Authorization') !== '3cdcnTiBsl') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
