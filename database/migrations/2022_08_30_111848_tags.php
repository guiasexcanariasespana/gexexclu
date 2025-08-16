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
        Schema::create('tags', function (Blueprint $table) {

            $table->id();
            $table->string('nombre');
            $table->string('slug');
            $table->string('color');
            $table->enum('visible', ['Si', 'No'])->default('Si'); // 1 -visible 2 -oculto
            $table->enum('menu', ['Si', 'No'])->default('No'); // 1 -visible 2 -oculto
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
        Schema::dropIfExists('tags');
    }
};
