<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = $request->route('user'); // Asume que 'user' es el parámetro de ruta
        
        if ($user->id == Auth::id() || Auth::user()->admin) {
            return $next($request);
        }

        return redirect()->route('users.index');
    }
}
