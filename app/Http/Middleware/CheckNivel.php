<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckNivel
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Verifica se a role do usuário está na lista permitida
        if (!in_array($user->role, $roles)) {
            abort(403, 'Acesso negado. Você não tem permissão para esta área.');
        }

        return $next($request);
    }
}