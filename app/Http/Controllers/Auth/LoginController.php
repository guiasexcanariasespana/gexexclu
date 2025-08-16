<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de login.
     */
    public function showLoginForm(Request $request)
    {
        return view('auth.login');
    }

    /**
     * Procesa el login según la ruta utilizada.
     */
    public function login(Request $request)
    {
        // Validar los datos del formulario.
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Intentar autenticar con las credenciales proporcionadas.
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Verificamos la ruta usada para el login.
            $isAdminLogin = $request->is('bielsa22admin/login') || str_starts_with($request->path(), 'bielsa22admin');


            if ($isAdminLogin) {
                // Si la ruta es la de admin, el usuario debe tener el rol 'admin'.
                if ($user->hasRole('Admin')) {
                    return redirect()->intended('nob1903/rosarioadmin/home');
                }
                // Si el usuario autenticado no es admin, se cierra la sesión.
                Auth::logout();
                return redirect()->back()->withInput($request->only('email'))
                                         ->withErrors(['email' => 'Utilice la ruta de usuario para iniciar sesión.']);
            } else {
                // En la ruta normal, se debe impedir que un admin ingrese.
                if ($user->hasRole('Admin')) {
                    Auth::logout();
                    return redirect()->back()->withInput($request->only('email'));
                }
                // Si el usuario es del tipo correcto, se redirige.
                return redirect()->intended('/');
            }
        }

        // En caso de fallo en la autenticación.
        return redirect()->back()->withInput($request->only('email'))
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
