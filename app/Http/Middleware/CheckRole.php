<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!empty($roles) && !in_array(Auth::user()->role, $roles)) {
            // Redirect ke dashboard sesuai role dengan pesan error
            $redirectRoute = Auth::user()->isAdmin() ? 'admin.dashboard' : 'dashboard';
            return redirect()->route($redirectRoute)->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}