<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_with_valid_credentials()
    {
        // Crear un usuario con credenciales válidas
        $user = User::create([
            'nombre' => 'Valid User',
            'correo' => 'valid@example.com',
            'contraseña' => Hash::make('Password1!'),
            'estado' => 1, // Usuario activo
        ]);

        // Intentar iniciar sesión con credenciales válidas
        $response = $this->withoutMiddleware()->post('/login', [
            'correo' => 'valid@example.com',
            'contraseña' => 'Password1!',
        ]);

        // Verificar que la redirección es correcta
        $response->assertRedirect('/home'); // Cambia esto si es necesario
    }

    public function test_login_with_invalid_credentials()
    {
        // Intentar iniciar sesión con credenciales incorrectas
        $response = $this->withoutMiddleware()->post('/login', [
            'correo' => 'wrong@example.com', // Correo no existente
            'contraseña' => 'WrongPassword!',  // Contraseña incorrecta
        ]);

        // Verificar que se muestre un mensaje de error para el correo
        $response->assertSessionHasErrors(['correo']);
        $this->assertEquals('Las credenciales proporcionadas son incorrectas o el usuario no está activo.', session('errors')->get('correo')[0]);
    }

    public function test_login_with_inactive_user()
    {
        // Crear un usuario inactivo
        $user = User::create([
            'nombre' => 'Inactive User',
            'correo' => 'inactive@example.com',
            'contraseña' => Hash::make('Password1!'),
            'estado' => 0, // Usuario inactivo
        ]);

        // Intentar iniciar sesión con el usuario inactivo
        $response = $this->withoutMiddleware()->post('/login', [
            'correo' => 'inactive@example.com',
            'contraseña' => 'Password1!',
        ]);

        // Verificar que se muestre un mensaje de error para el correo
        $response->assertSessionHasErrors(['correo']);
        $this->assertEquals('Las credenciales proporcionadas son incorrectas o el usuario no está activo.', session('errors')->get('correo')[0]);
    }

    public function test_login_with_empty_email()
    {
        // Intentar iniciar sesión con un correo vacío
        $response = $this->withoutMiddleware()->post('/login', [
            'correo' => '', // Correo vacío
            'contraseña' => 'Password1!',
        ]);

        // Verificar que se muestre un mensaje de error para el correo
        $response->assertSessionHasErrors(['correo']);
    }

    public function test_login_with_empty_password()
    {
        // Intentar iniciar sesión con una contraseña vacía
        $response = $this->withoutMiddleware()->post('/login', [
            'correo' => 'valid@example.com',
            'contraseña' => '', // Contraseña vacía
        ]);

        // Verificar que se muestre un mensaje de error para la contraseña
        $response->assertSessionHasErrors(['contraseña']);
    }

    public function test_login_with_incorrect_password()
    {
        // Crear un usuario con credenciales válidas
        $user = User::create([
            'nombre' => 'User',
            'correo' => 'user@example.com',
            'contraseña' => Hash::make('Password1!'),
            'estado' => 1, // Usuario activo
        ]);

        // Intentar iniciar sesión con el correo correcto y una contraseña incorrecta
        $response = $this->withoutMiddleware()->post('/login', [
            'correo' => 'user@example.com',
            'contraseña' => 'WrongPassword!', // Contraseña incorrecta
        ]);

        // Verificar que se muestre un mensaje de error para la contraseña
        $response->assertSessionHasErrors(['correo']);
        $this->assertEquals('La contraseña proporcionada es incorrecta.', session('errors')->get('correo')[0]);
    }

    // Puedes añadir más pruebas relacionadas al inicio de sesión aquí
}
