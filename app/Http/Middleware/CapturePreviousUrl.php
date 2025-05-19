<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CapturePreviousUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // List of routes we don't want to capture as intended
        $excludedRoutes = [
            'customer-sign-in',
            'logout',
            'cart/*',        // avoid cart
            'api/*',         // avoid API calls
            'checkout/*',    // maybe avoid checkout too
        ];

        if (
            $request->method() === 'GET' &&
            !$request->ajax() &&
            !$request->expectsJson() &&
            !$request->is(...$excludedRoutes)
        ) {
            // Save latest good full URL
            session(['url.intended' => $request->fullUrl()]);
        }

        return $next($request);
    }
}
