<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    /**
     * FORMULARIO CORRECTO:
     *  - Datos válidos
     *  - Redirección
     *  - Mensaje de éxito
     *  - Email enviado
     */
    public function test_envio_correcto_del_formulario_de_contacto()
    {
        Mail::fake();

        $payload = [
            'nombre' => 'Mauricio Terrones',
            'email' => 'mauricio@example.com',
            'mensaje' => 'Necesito más información sobre el sistema.'
        ];

        $response = $this->post('/contacto', $payload);

        $response->assertStatus(302);
        $response->assertSessionHas('success');

        Mail::assertSent(function ($mail) {
            return true;
        });
    }

    /**
     * Validación de campos del formulario
     */
    public function test_validacion_formulario_contacto()
    {
        $response = $this->post('/contacto', []);

        $response->assertSessionHasErrors(['nombre', 'email', 'mensaje']);
    }
}
