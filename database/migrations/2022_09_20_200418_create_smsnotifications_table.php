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
        Schema::create('smsnotifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); #usuario id del creador   
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('anuncio_id')->nullable(); #usuario id del creador   
            $table->foreign('anuncio_id')->references('id')->on('anuncios');
            $table->string('telefono')->nullable();
            $table->string('mensaje')->nullable();
            $table->string('respuesta')->nullable();
            $table->string('sms_id')->nullable();
            $table->string('error_id')->nullable();
            $table->string('error_msg')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('smsnotifications');
    }
};
