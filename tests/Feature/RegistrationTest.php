<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_name_is_required()
    {
        $response = $this->withoutMiddleware()->post('/register', [
            'nombre' => '',
            'correo' => 'test@example.com',
            'contraseña' => 'Password1!',
            'contraseña_confirmation' => 'Password1!',
        ]);
        $response->assertSessionHasErrors(['nombre']);
    }


    public function test_email_is_required()
    {
        $response = $this->withoutMiddleware()->post('/register', [
            'nombre' => 'John Doe',
            'correo' => '',
            'contraseña' => 'Password1!',
            'contraseña_confirmation' => 'Password1!',
        ]);
        $response->assertSessionHasErrors(['correo']);
    }

    public function test_email_must_be_valid()
    {
        $response = $this->withoutMiddleware()->post('/register', [
            'nombre' => 'John Doe',
            'correo' => 'notanemail',
            'contraseña' => 'Password1!',
            'contraseña_confirmation' => 'Password1!',
        ]);
        $response->assertSessionHasErrors(['correo']);
    }

    public function test_email_must_be_unique()
    {
        // Crear un usuario existente
        User::create([
            'nombre' => 'Existing User',
            'correo' => 'test@example.com',
            'contraseña' => Hash::make('Password1!'),
        ]);

        $response = $this->withoutMiddleware()->post('/register', [
            'nombre' => 'John Doe',
            'correo' => 'test@example.com', // Correo duplicado
            'contraseña' => 'Password1!',
            'contraseña_confirmation' => 'Password1!',
        ]);
        $response->assertSessionHasErrors(['correo']);
    }

    public function test_password_is_required()
    {
        $response = $this->withoutMiddleware()->post('/register', [
            'nombre' => 'John Doe',
            'correo' => 'test@example.com',
            'contraseña' => '',
            'contraseña_confirmation' => '',
        ]);
        $response->assertSessionHasErrors(['contraseña']);
    }

    public function test_password_must_have_minimum_length()
    {
        $response = $this->withoutMiddleware()->post('/register', [
            'nombre' => 'John Doe',
            'correo' => 'test@example.com',
            'contraseña' => 'short', // Menos de 8 caracteres
            'contraseña_confirmation' => 'short',
        ]);
        $response->assertSessionHasErrors(['contraseña']);
    }

    public function test_password_must_contain_uppercase()
    {
        $response = $this->withoutMiddleware()->post('/register', [
            'nombre' => 'John Doe',
            'correo' => 'test@example.com',
            'contraseña' => 'lowercase1!', // Sin mayúsculas
            'contraseña_confirmation' => 'lowercase1!',
        ]);
        $response->assertSessionHasErrors(['contraseña']);
    }
    public function test_password_confirmation_must_match()
    {
        $response = $this->withoutMiddleware()->post('/register', [
            'nombre' => 'John Doe',
            'correo' => 'test@example.com',
            'contraseña' => 'Password1!',
            'contraseña_confirmation' => 'Password2!', // No coincide
        ]);
        $response->assertSessionHasErrors(['contraseña']);
    }
    
    public function test_name_must_contain_at_least_one_space()
{
    $response = $this->withoutMiddleware()->post('/register', [
        'nombre' => 'John', // Sin espacio
        'correo' => 'test@example.com',
        'contraseña' => 'Password1!',
        'contraseña_confirmation' => 'Password1!',
    ]);
    $response->assertSessionHasErrors(['nombre']);
}

public function test_name_must_not_contain_special_characters()
{
    $response = $this->withoutMiddleware()->post('/register', [
        'nombre' => 'John@Doe', // Contiene un carácter especial
        'correo' => 'test@example.com',
        'contraseña' => 'Password1!',
        'contraseña_confirmation' => 'Password1!',
    ]);
    $response->assertSessionHasErrors(['nombre']);
}

public function test_name_must_not_contain_numbers()
{
    $response = $this->withoutMiddleware()->post('/register', [
        'nombre' => 'John123 Doe', // Contiene números
        'correo' => 'test@example.com',
        'contraseña' => 'Password1!',
        'contraseña_confirmation' => 'Password1!',
    ]);
    $response->assertSessionHasErrors(['nombre']);
}

public function test_name_must_not_exceed_maximum_length()
{
    $longName = str_repeat('A', 101); // 101 caracteres
    $response = $this->withoutMiddleware()->post('/register', [
        'nombre' => $longName,
        'correo' => 'test@example.com',
        'contraseña' => 'Password1!',
        'contraseña_confirmation' => 'Password1!',
    ]);
    $response->assertSessionHasErrors(['nombre']);
}

}
