<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        // Aktuellen Benutzer abrufen
        $userPermissions = Auth::user()->role->permissions;

        // Überprüfen, ob der Benutzer über eine der erforderlichen Berechtigungen verfügt
        $hasPermission = collect($permissions)->every(function ($permission) use ($userPermissions) {
            return in_array($permission, $userPermissions);
        });

        if (!$hasPermission) {
            // Wenn nicht, Zugriff verweigern
            return redirect()->back()->with('error', 'Dafür hast du keine Berechtigung'); // Oder eine andere Route, die anzeigt, dass der Benutzer keine Berechtigung hat
        }

        return $next($request);
    }
}
