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
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); #usuario id del creador   
            $table->foreign('user_id')->references('id')->on('users');         
            
            $table->string('nombre');
            $table->string('slug');
            $table->string('titulo');
            $table->string('presentacion')->nullable();
            #$table->string('icono_bandera')->nullable();
            #$table->string('idiomas')->nullable();
            #$table->string('tipo'); #Doble o Normal
            $table->enum('tipo', ['Doble', 'Normal'])->default('Normal');
            #$table->string('orientacion')->nullable(); #Hetero, bi
            $table->enum('orientacion', ['Heterosexual', 'Bisexual', 'Homosexual', 'Otra'])->default('Heterosexual');
            $table->string('telefono')->nullable();
            $table->string('whatsapp')->nullable();

            #$table->tinyInteger('categoria')->nullable(); #categoria id
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            
           # $table->string('clase')->nullable(); #clase_id 
            $table->unsignedBigInteger('clase_id')->nullable();
            $table->foreign('clase_id')->references('id')->on('clases');
            #$table->tinyInteger('provincia')->nullable(); #state_id
            // $table->unsignedBigInteger('state_id')->nullable();
            // $table->foreign('state_id')->references('id')->on('states');
            #$table->string('zona')->nullable();  #Aca a mano se ingresa la localidad
            $table->unsignedBigInteger('provincia_id')->nullable();
            $table->foreign('provincia_id')->references('id')->on('provincias');

            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->foreign('municipio_id')->references('id')->on('municipios');
            
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->foreign('zone_id')->references('id')->on('zones');
            
            $table->string('localidad')->nullable(); #Aca esta el id de zona zona_id

            #$table->string('plan')->nullable(); #modalidad_pago_id
            $table->unsignedBigInteger('plane_id');
            $table->foreign('plane_id')->references('id')->on('planes');
            $table->decimal('precio', $precision = 9, $scale = 2)->nullable();
            $table->integer('dias')->nullable();          
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('edad')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('profesion')->nullable();
           # $table->string('color_de_pelo')->nullable();
           # $table->string('color_de_ojos')->nullable();
            #$table->string('altura')->nullable();
            #$table->string('pecho')->nullable();
            #$table->string('formas_de_pago_admitidas')->nullable(); #foma_pago_id
            #$table->string('servicios_ofrecidos')->nullable();
            #$table->string('lugares_de_atencion')->nullable();
            #$table->string('horario')->nullable();
            $table->string('gps')->nullable();
            # $table->string('pagina_web')->nullable();

            #$table->string('codigo_video')->nullable();
            #$table->string('estado_de_fotos')->nullable();

            $table->string('ip_address', 64)->nullable();
            $table->integer('port')->nullable();
           
            #$table->string('tarifas')->nullable(); #Campo de Texto
           # $table->tinyInteger('activo')->nullable();
            $table->enum('estado', ['Borrador', 'Publicado', 'Pausado', 'Finalizado', 'Suspendido', 'Rechazado'])->default('Borrador');
            #$table->string('video_ftp')->nullable();
            # $table->string('modalidad_de_pago')->nullable(); #Plan que compro ej: plan 30
           
           # $table->string('piel')->nullable();
            #$table->string('tipo_de_pecho')->nullable();
            #$table->string('peso')->nullable();
            #$table->string('cuerpo')->nullable();
            #$table->string('trabajo')->nullable();
            $table->tinyInteger('destacado')->nullable();
            #  $table->string('tipo_anuncio')->nullable();
            # $table->tinyInteger('verificado')->nullable();
            # $table->string('esperando_validacion')->nullable();
            #$table->dateTime('fecha_de_alta')->nullable();
            $table->dateTime('fecha_de_publicacion')->nullable();
            $table->date('fecha_caducidad')->nullable();
            $table->dateTime('fecha_pausa')->nullable();
            $table->enum('verificacion', ['Pendiente', 'Si', 'Rechazado'])->default('Pendiente');
            $table->integer('paso')->nullable();
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
        //
        Schema::dropIfExists('anuncios');
    }
};
