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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telefono')->nullable();
            
            $table->string('direccion')->nullable();
            $table->string('gps')->nullable();
            $table->string('provincia')->nullable();
            $table->string('presentacion')->nullable();
            $table->tinyInteger('activo')->nullable();
           
            $table->string('localidad')->nullable();
            $table->string('direccion_a_mostrar')->nullable();
            $table->string('codigo_video')->nullable();
            $table->dateTime('fecha_de_nacimiento')->nullable();
            $table->dateTime('fecha_de_alta')->nullable();
            $table->dateTime('fecha_caducidad')->nullable();
            $table->dateTime('fecha_pausa')->nullable();
            $table->string('limite_de_anuncios')->nullable();
            $table->string('tipo')->nullable();
            $table->string('pagina_web')->nullable();
            $table->string('plan')->nullable();
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->string('ip_al_registrarse')->nullable();
            $table->string('horario')->nullable();
            $table->string('whatsapp')->nullable();
            $table->enum('estado_wsp', ['Pendiente', 'Validado'])->default('Pendiente');
            $table->string('codigo_ws')->nullable();
            $table->integer('paso')->nullable();
            $table->tinyInteger('autovalidar')->nullable();
            $table->dateTime('caducidad_de_cuenta', $precision = 0)->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
};
