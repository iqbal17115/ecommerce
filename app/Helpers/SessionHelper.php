<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class SessionHelper
{
    public static function getSessionId(): string
    {
        // Check for persistent cart cookie (for guests)
        if (!Cookie::has('cart_session_id')) {
            $sessionId = session()->getId();
            Cookie::queue('cart_session_id', $sessionId, 60 * 24 * 7); // 7 days
            return $sessionId;
        }

        return Cookie::get('cart_session_id');
    }

    public static function isGuest(): bool
    {
        return !Auth::check();
    }
}
