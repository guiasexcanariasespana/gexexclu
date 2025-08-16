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
        Schema::table('anuncios', function (Blueprint $table) {
            $table->decimal('treinta_minutos', $precision = 7, $scale = 2)->nullable();
            $table->decimal('cuarenta_y_cinco_minutos', $precision = 7, $scale = 2)->nullable();
            $table->decimal('una_hora', $precision = 7, $scale = 2)->nullable();
            $table->decimal('medio_dia', $precision = 7, $scale = 2)->nullable();
            $table->decimal('todo_el_dia', $precision = 7, $scale = 2)->nullable();
            $table->decimal('fin_de_semana', $precision = 7, $scale = 2)->nullable();
            $table->decimal('hora_desplazamiento', $precision = 7, $scale = 2)->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn('treinta_minutos');
            $table->dropColumn('cuarenta_y_cinco_minutos');
            $table->dropColumn('una_hora');
            $table->dropColumn('medio_dia');
            $table->dropColumn('todo_el_dia');
            $table->dropColumn('fin_de_semana');
            $table->dropColumn('hora_desplazamiento');            

        });
    }
};
