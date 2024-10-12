<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => [
                'required', 
                'string', 
                'max:100',
               'regex:/^(?=.*\s)[A-Za-zÀ-ÿ\s]+$/',
            ],
            'correo' => ['required', 'string', 'email', 'max:100', 'unique:usuarios,correo'],
            'contraseña' => [
                'required',
                'string',
                'min:8', // Al menos 8 caracteres
                'confirmed', // Debe coincidir con la confirmación
                'regex:/[A-Z]/', // Al menos una letra mayúscula
                'regex:/[!@#$%^&*(),.?":{}|<>]/', // Al menos un carácter especial
            ],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo debe contener letras y espacios.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'contraseña.required' => 'La contraseña es obligatoria.',
            'contraseña.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'contraseña.confirmed' => 'La confirmación de la contraseña no coincide.',
            'contraseña.regex' => 'La contraseña debe contener al menos una letra mayúscula y un carácter especial.',
        ]);
    }




    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nombre' => $data['nombre'], // Asegúrate de que este campo coincide con tu base de datos
            'correo' => $data['correo'], // Cambiado de 'email' a 'correo'
            'contraseña' => Hash::make($data['contraseña']), // Cambiado de 'password' a 'contraseña' y asegúrate de usar el hash para la contraseña
            'id_rol' => 2, // O el rol que desees asignar por defecto
        ]);
        
    }
    protected function registered(Request $request, $user)
    {
        // Cambia la redirección aquí
        return redirect()->route('register')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }
}
