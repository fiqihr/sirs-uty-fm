<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // if ($user->hak_akses == 'penyiar') {
        //     return redirect()->route('dashboard.penyiar');
        // }

        if (!in_array($user->hak_akses, $roles)) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}