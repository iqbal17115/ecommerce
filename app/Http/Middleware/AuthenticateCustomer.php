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
        // If the user is not authenticated, redirect to the login page
        return redirect()->route('customer-sign-in');
    }
}
