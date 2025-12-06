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
    Schema::create('formularios_contacto', function (Blueprint $table) {
        $table->id();
        $table->string('tipo_solicitante'); // 'persona' o 'empresa'
        $table->string('nombre_completo');
        $table->string('numero_celular'); // Número de WhatsApp
        $table->string('correo_electronico');
        $table->string('ruc')->nullable(); // Campo para RUC (si es empresa)
        $table->string('razon_social')->nullable(); // Razón Social (si es empresa)
        $table->string('nombre_empresa')->nullable(); // Nombre de la Empresa (si es empresa)
        $table->text('mensaje'); // Contenido del mensaje/consulta
        $table->boolean('atendido')->default(false); // Para el seguimiento del administrador
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formularios_contacto');
    }
};
