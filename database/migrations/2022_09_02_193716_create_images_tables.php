<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagens', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('position')->nullable();
            #$table->string('formato');
            #$table->integer('anuncio_id')->references('id')->on('anuncios');

            $table->unsignedBigInteger('anuncio_id')->nullable();
            $table->foreign('anuncio_id')->references('id')->on('anuncios');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->enum('portada', ['Si', 'No'])->default('No');

            $table->enum('estado', ['Pendiente', 'Verificada', 'Rechazado'])->default('Pendiente');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagens');
    }
};
