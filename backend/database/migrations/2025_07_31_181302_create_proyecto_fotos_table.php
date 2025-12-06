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
        Schema::create('proyecto_fotos', function (Blueprint $table) {
            $table->id(); // ID autoincremental, clave primaria
            $table->foreignId('proyecto_id')->constrained()->onDelete('cascade'); // Clave foránea que referencia a la tabla 'proyectos'
            $table->string('path'); // Ruta del archivo de la foto
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_fotos');
    }
};