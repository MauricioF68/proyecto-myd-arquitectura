<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ENVÍO DE EMAIL DE RECUPERACIÓN:
     *  - Email registrado
     *  - Token generado
     *  - Estado correcto en sesión
     */
    public function test_envio_de_enlace_de_recuperacion_es_correcto()
    {
        $user = User::factory()->create(['email' => 'mauricio@example.com']);

        $response = $this->post('/forgot-password', [
            'email' => 'mauricio@example.com'
        ]);

        $response->assertStatus(302);

        $this->assertEquals(
            Password::RESET_LINK_SENT,
            session('status')
        );
    }

    /**
     * Email inexistente debe producir error
     */
    public function test_recuperacion_falla_con_email_inexistente()
    {
        $response = $this->post('/forgot-password', [
            'email' => 'inexistente@example.com'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
    }
}
