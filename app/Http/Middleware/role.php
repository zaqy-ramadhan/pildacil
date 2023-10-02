<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, $role)
    // {
    //     if ($request->user()->role == $role) {
    //         return $next($request);
    //     }

    //     abort(403, 'Access Granted');
    //     return redirect()
    //         ->to(route('login'));
    // }
    public function handle($request, Closure $next, ...$roles)
    {
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
        return redirect()->to(route('login'));
    }
}
