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
        Schema::table('municipios', function (Blueprint $table) {
            $table->unsignedBigInteger('isla_id')->nullable();
            $table->foreign('isla_id')->references('id')->on('islas');
            $table->index('isla_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('municipios', function (Blueprint $table) {
            //
            $table->dropIndex(['isla_id']);
            $table->dropColumn('isla_id');
        });
    }
};
