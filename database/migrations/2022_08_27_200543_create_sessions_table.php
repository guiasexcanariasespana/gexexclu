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
        if (Schema::hasTable('sessions')) {
            // Si la tabla ya existe, agregamos solo las columnas faltantes
            Schema::table('sessions', function (Blueprint $table) {
                if (!Schema::hasColumn('sessions', 'id')) {
                    $table->string('id')->primary();
                }
                if (!Schema::hasColumn('sessions', 'user_id')) {
                    $table->foreignId('user_id')->nullable()->index();
                }
                if (!Schema::hasColumn('sessions', 'ip_address')) {
                    $table->string('ip_address', 45)->nullable();
                }
                if (!Schema::hasColumn('sessions', 'user_agent')) {
                    $table->text('user_agent')->nullable();
                }
                if (!Schema::hasColumn('sessions', 'payload')) {
                    $table->longText('payload');
                }
                if (!Schema::hasColumn('sessions', 'last_activity')) {
                    $table->integer('last_activity')->index();
                }
            });
        } else {
            // Si la tabla no existe, la creamos completa
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Solo eliminamos columnas si existen, no la tabla completa
        Schema::table('sessions', function (Blueprint $table) {
            $columnsToDrop = ['user_id', 'ip_address', 'user_agent', 'payload', 'last_activity'];
            
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('sessions', $column)) {
                    $table->dropColumn($column);
                }
            }
            
            // No eliminamos la columna 'id' ya que es la primary key
        });
    }
};
