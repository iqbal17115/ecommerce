<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateCustomer
{
    public function handle($request, Closure $next)
    {
        dd(Auth::user());
        // Use the 'auth' middleware instead of checking with Auth::check()
        if (auth()->check()) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthenticated', 'redirect' => route('customer-sign-in')], 401);
    }
}
