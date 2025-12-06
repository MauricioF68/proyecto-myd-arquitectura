<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('proyectos', function (Blueprint $table) {
        $table->id(); // ID autoincremental, clave primaria
        $table->string('titulo'); // Título del proyecto
        $table->text('descripcion'); // Texto/descripción del proyecto
        $table->string('estadisticas')->nullable(); // Campo para estadísticas (ej. "95% completado")
        $table->string('tiempo_trabajado')->nullable(); // Campo para el tiempo trabajado (ej. "3 meses")
        $table->string('nombre_empresa_cliente'); // Nombre de la empresa cliente
        $table->string('foto_empresa_cliente')->nullable(); // Ruta de la foto de la empresa
        $table->boolean('notificar_clientes')->default(true); // Controla si se notifica
        $table->timestamps(); // Columnas created_at y updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
