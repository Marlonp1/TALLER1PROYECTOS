<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home'; // Cambia esto si deseas redirigir a otra ruta

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function username()
    {
        return 'correo'; 
    }

    protected function credentials(Request $request)
    {
        return [
            'correo' => $request->correo,
            'contraseña' => $request->contraseña // Cambia 'contraseña' a 'password'
        ];
    }

    public function login(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'correo' => 'required|string|email',
            'contraseña' => 'required|string',
        ]);

        // Buscar al usuario en la tabla 'usuarios'
        $user = User::where('correo', $request->correo)->first();

        // Verificar si el usuario existe y si está activo
        if ($user && $user->estado == 1) {
            // Verificar si la contraseña coincide
            if (Hash::check($request->contraseña, $user->contraseña)) {
                // Iniciar sesión
                Auth::login($user);

                // Redirigir según el rol
                if ($user->id_rol == 2) {
                    return redirect()->route('ruta_del_profesor'); // Cambia 'ruta_del_profesor' a tu ruta específica
                }

                return redirect()->intended($this->redirectTo);
            } else {
                return back()->withErrors([
                    'correo' => 'La contraseña proporcionada es incorrecta.',
                ])->onlyInput('correo');
            }
        }

        // Si el usuario no fue encontrado o no está activo
        return back()->withErrors([
            'correo' => 'Las credenciales proporcionadas son incorrectas o el usuario no está activo.',
        ])->onlyInput('correo');
    }
}
