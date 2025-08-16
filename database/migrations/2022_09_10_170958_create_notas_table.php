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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); #usuario id del creador   
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('anuncio_id')->nullable(); #usuario id del creador   
            $table->foreign('anuncio_id')->references('id')->on('anuncios');
            $table->string('titulo');            
            $table->text('nota')->nullable();
            $table->enum('estado', ['Pendiente', 'Vista'])->default('Pendiente');
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
        Schema::dropIfExists('notas');
    }
};
