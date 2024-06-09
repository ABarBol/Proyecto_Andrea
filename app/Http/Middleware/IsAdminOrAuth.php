<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdminOrAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->admin) {
            return $next($request);
        } else {
            foreach (Auth::user()->groups as $group) {
                if (is_object($request->group)) {
                    if ($group->id == $request->group->id) {
                        return $next($request);
                    }
                } else {
                    if ($group->id == $request->group) {
                        return $next($request);
                    }
                }
            }
        }

        return redirect()->route('users.show', Auth::user());
    }
}
