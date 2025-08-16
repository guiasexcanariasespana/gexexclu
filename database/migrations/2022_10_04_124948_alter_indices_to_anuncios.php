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
            $table->index('user_id');
            $table->index('categoria_id');
            $table->index('clase_id');
            $table->index('provincia_id');
            $table->index('municipio_id');
            $table->index('estado');
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
            $table->dropIndex(['user_id']);
            $table->dropIndex(['categoria_id']);
            $table->dropIndex(['clase_id']);
            $table->dropIndex(['provincia_id']);
            $table->dropIndex(['municipio_id']);
            $table->dropIndex(['estado']);
        });
    }
};
