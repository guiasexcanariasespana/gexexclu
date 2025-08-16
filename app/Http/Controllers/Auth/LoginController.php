<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Mostrar formulario de login para usuarios.
     */
    public function showLoginForm()
    {
        return view('auth.login', [
            'isAdminLogin' => false
        ]);
    }

    /**
     * Mostrar formulario de login para administradores.
     */
    public function showAdminLoginForm()
    {
        return view('auth.login', [
            'isAdminLogin' => true
        ]);
    }

    /**
     * Procesar el login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $isAdminLogin = $request->routeIs('admin.login.post');

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if ($isAdminLogin) {
                // Si es login de admin, validar rol
                if ($user->hasRole('Admin')) {
                    return redirect()->intended('nob1903/rosarioadmin/home');
                }

                Auth::logout();
                return redirect()->route('login')
                    ->withErrors(['email' => 'No tienes acceso de administrador.']);
            } else {
                // Si es login de usuario normal, impedir que admin use esta ruta
                if ($user->hasRole('Admin')) {
                    Auth::logout();
                    return redirect()->route('admin.login')
                        ->withErrors(['email' => 'Debes iniciar sesión en el portal de administradores.']);
                }

                return redirect()->intended('/');
            }
        }

        return back()->withInput($request->only('email'))
                     ->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
