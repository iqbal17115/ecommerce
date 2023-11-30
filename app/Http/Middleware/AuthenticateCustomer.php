<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateCustomer
{
    public function handle($request, Closure $next)
    {
        // Use the 'auth' middleware instead of checking with Auth::check()
        if (auth()->check()) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthenticated', 'redirect' => route('customer-sign-in')], 401);
    }
}
