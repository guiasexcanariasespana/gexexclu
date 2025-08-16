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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); #usuario id del creador   
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('mail_pago')->nullable(); #mail del pago
            $table->unsignedBigInteger('anuncio_id')->nullable(); #anuncio que abono   
            $table->foreign('anuncio_id')->references('id')->on('anuncios');
            $table->string('moneda_precio')->nullable(); #moneda del precio del anuncio
            $table->decimal('precio', $precision = 9, $scale = 2)->nullable(); #precio dle anuncio
            $table->string('moneda_pago')->nullable(); #moneda en la que se pago
            $table->decimal('monto_pago', $precision = 9, $scale = 2)->nullable(); #monto que se abono
            $table->decimal('fee', $precision = 9, $scale = 2)->nullable(); #monto que se abono
            $table->string('medio_pago')->nullable(); # si abono con paypal, bizun o cual
            $table->string('nro_transac')->nullable(); #nro del pago
            $table->dateTime('fecha_transac')->nullable(); #fecha del pago
            $table->string('estado')->nullable(); #Aca esta el id de zona zona_id
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
        Schema::dropIfExists('pagos');
    }
};
