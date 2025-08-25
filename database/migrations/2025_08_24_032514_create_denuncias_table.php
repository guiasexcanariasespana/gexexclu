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
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            
            // Campo user_id (no obligatorio)
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null')
                  ->comment('Usuario que realiza la denuncia (opcional)');
            
            // Campos obligatorios
            $table->string('nombre', 100);
            $table->string('telefono', 20);
            $table->string('email', 100);
            $table->string('motivo_denuncia', 200);
            $table->text('mensaje');
            
            // Relación con la tabla anuncios
            $table->foreignId('anuncio_id')
                  ->constrained('anuncios')
                  ->onDelete('cascade')
                  ->comment('Anuncio que se está denunciando');
            
            // Timestamps automáticos
            $table->timestamps();
            
            // Índices para mejorar el rendimiento
            $table->index('email');
            $table->index('anuncio_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncias');
    }
};