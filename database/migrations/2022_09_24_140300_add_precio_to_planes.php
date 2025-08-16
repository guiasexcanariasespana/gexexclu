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
        Schema::table('planes', function (Blueprint $table) {
            $table->string('moneda_precio')->nullable(); #moneda del precio del anuncio
            $table->decimal('precio', $precision = 9, $scale = 2)->nullable(); #precio dle anuncio
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planes', function (Blueprint $table) {
            $table->dropColumn('moneda_precio');
            $table->dropColumn('precio');
        });
    }
};
