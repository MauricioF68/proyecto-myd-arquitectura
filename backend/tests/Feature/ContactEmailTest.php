<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoMail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactEmailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica:
     * - Modelo de correo
     * - Envío a destinatario correcto
     * - Datos estructurados dentro del correo
     */
    public function test_envio_profesional_de_correo_de_contacto()
    {
        Mail::fake();

        $data = [
            'nombre' => 'Mauricio',
            'email' => 'correo@example.com',
            'mensaje' => 'Soy un cliente, deseo información.'
        ];

        Mail::to('admin@example.com')->send(new ContactoMail($data));

        Mail::assertSent(ContactoMail::class, function ($mail) use ($data) {
            return $mail->hasTo('admin@example.com')
                && $mail->nombre === $data['nombre']
                && $mail->email === $data['email']
                && $mail->mensaje === $data['mensaje'];
        });
    }
}
