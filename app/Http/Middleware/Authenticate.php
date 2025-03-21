<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // When not sign in then redirect
        if (!$request->expectsJson()) {
            return route('customer-sign-in');
        }
        // if (Auth::user()->hasRole('admin|user')) {

        //     return redirect(RouteServiceProvider::HOME);
        // } else {
        //     return route('home');
        // }
    }
}
