<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    
     public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login', 302)->with('success', 'Logout feito com sucesso!');
        return redirect()->back()->with('error', 'Erro ao fazer logout. Tente novamente.');
    }

    protected function authenticated(Request $request, $user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect('/admin')->with('success', "Bem-vindo, {$user->name}!");

            case 'employee':
                return redirect('/admin/brands')->with('success', "Bem-vindo, {$user->name}!");

            case 'financial':
                return redirect('/admin/financeiro/reserves')->with('success', "Bem-vindo, {$user->name}!");

            default:
                Auth::logout();
                return redirect('/login')->with('error', 'Papel inválido.');
        }
    }
        

    
    
}
