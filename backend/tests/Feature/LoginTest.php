<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * LOGIN COMPLETO:
     *  - Usuario válido
     *  - Password correcta
     *  - Autenticación
     *  - Redirección
     *  - No errores de validación
     */
    public function test_login_con_credenciales_correctas()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('12345678')
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => '12345678'
        ]);

        // 1. Usuario autenticado
        $this->assertAuthenticatedAs($user);

        // 2. Redirección a dashboard
        $response->assertRedirect('/dashboard');
    }

    /**
     * LOGIN FALLIDO:
     *  - Password equivocada
     *  - No autenticación
     *  - Mensaje de error
     */
    public function test_login_falla_con_password_incorrecta()
    {
        $user = User::factory()->create([
            'email' => 'juan@example.com',
            'password' => Hash::make('correcto123')
        ]);

        $response = $this->post('/login', [
            'email' => 'juan@example.com',
            'password' => 'incorrecto'
        ]);

        // El usuario NO debe autenticarse
        $this->assertGuest();

        // Mensaje de error de login
        $response->assertSessionHasErrors(['email']);
    }
}
