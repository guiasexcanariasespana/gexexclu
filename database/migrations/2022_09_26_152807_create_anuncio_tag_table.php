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
        Schema::create('anuncio_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anuncio_id')->index();
            $table->unsignedBigInteger('tag_id')->index();

            $table->foreign('anuncio_id')->references('id')->on('anuncios')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anuncio_tag');
    }
};
