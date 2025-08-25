<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\RateLimiter;

class ThrottleMailSending
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $key = 'mail-throttle:' . ($user ? $user->id : $request->ip());

        if (RateLimiter::tooManyAttempts($key, 1)) {
            return redirect()->route('startseite')->with('error', 'Bitte warte noch 2 Minuten, bevor du eine weitere Mail anforderst');
        }

        RateLimiter::hit($key, 120);

        return $next($request);
    }
}
