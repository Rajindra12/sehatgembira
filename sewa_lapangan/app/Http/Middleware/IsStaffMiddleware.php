<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsStaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN rolenya ada di dalam daftar ['admin', 'staff']
        if (auth()->check() && in_array(auth()->user()->role, ['admin', 'staff'])) {
            return $next($request);
        }

        abort(403, 'Unauthorized Access');
    }
}
