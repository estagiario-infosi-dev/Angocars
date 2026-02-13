<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();

            // ADMIN → Dashboard
            if ($user->role === 'admin') {
                return redirect('/admin');
            }

            // EMPLOYEE → direto pras marcas
            if ($user->role === 'employee') {
                return redirect()->route('brands.index');
            }

            // FINANCIAL → direto pro financeiro
            if ($user->role === 'financial') {
                return redirect('financeiro.reserves');
            }

            // Qualquer outro (cliente, visitante, etc)
            return redirect('/');
        }
        

        return $next($request);
    }
}