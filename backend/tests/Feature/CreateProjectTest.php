<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Proyecto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProjectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * TEST PROFESIONAL:
     * Verifica la creación correcta de un proyecto:
     *  - Usuario autenticado
     *  - Validación de campos requeridos
     *  - Persistencia en base de datos
     *  - Confirmación de redirección
     *  - Mensaje de éxito en sesión
     *  - Que el proyecto pertenece al usuario autenticado
     */
    public function test_usuario_autenticado_puede_crear_un_proyecto_correctamente()
    {
        $user = User::factory()->create();

        $payload = [
            'nombre' => 'Proyecto MyD',
            'descripcion' => 'Proyecto de arquitectura e infraestructura.',
        ];

        $response = $this->actingAs($user)->post('/proyectos', $payload);

        // 1. Verificar redirección correcta
        $response->assertStatus(302);
        $response->assertRedirect('/proyectos');

        // 2. Verificar mensaje de éxito en sesión
        $response->assertSessionHas('success');

        // 3. Verificar registro en base de datos
        $this->assertDatabaseHas('proyectos', [
            'nombre' => 'Proyecto MyD',
            'user_id' => $user->id,
        ]);
    }

    /**
     * TEST DETALLADO:
     * Valida que si faltan campos requeridos, el sistema no guarde nada
     */
    public function test_validacion_de_campos_obligatorios_en_creacion_de_proyecto()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/proyectos', []);

        // Verificar errores específicos
        $response->assertSessionHasErrors(['nombre', 'descripcion']);

        // Verificar que no se haya creado ningún proyecto
        $this->assertEquals(0, Proyecto::count());
    }
}
