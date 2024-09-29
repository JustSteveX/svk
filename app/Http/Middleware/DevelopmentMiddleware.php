<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class DevelopmentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (App::isLocal() === true) {
            return $next($request);
        }

        // Falls nicht, leite den Benutzer weiter oder zeige eine Fehlermeldung an
        return abort(403, 'Unauthorized');
    }
}
