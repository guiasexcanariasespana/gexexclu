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
        if (Schema::hasTable('users')) {
            // Si la tabla ya existe, solo agregamos columnas faltantes
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'telefono')) {
                    $table->string('telefono')->nullable();
                }
                if (!Schema::hasColumn('users', 'direccion')) {
                    $table->string('direccion')->nullable();
                }
                if (!Schema::hasColumn('users', 'gps')) {
                    $table->string('gps')->nullable();
                }
                if (!Schema::hasColumn('users', 'provincia')) {
                    $table->string('provincia')->nullable();
                }
                if (!Schema::hasColumn('users', 'presentacion')) {
                    $table->string('presentacion')->nullable();
                }
                if (!Schema::hasColumn('users', 'activo')) {
                    $table->tinyInteger('activo')->nullable();
                }
                if (!Schema::hasColumn('users', 'localidad')) {
                    $table->string('localidad')->nullable();
                }
                if (!Schema::hasColumn('users', 'direccion_a_mostrar')) {
                    $table->string('direccion_a_mostrar')->nullable();
                }
                if (!Schema::hasColumn('users', 'codigo_video')) {
                    $table->string('codigo_video')->nullable();
                }
                if (!Schema::hasColumn('users', 'fecha_de_nacimiento')) {
                    $table->dateTime('fecha_de_nacimiento')->nullable();
                }
                if (!Schema::hasColumn('users', 'fecha_de_alta')) {
                    $table->dateTime('fecha_de_alta')->nullable();
                }
                if (!Schema::hasColumn('users', 'fecha_caducidad')) {
                    $table->dateTime('fecha_caducidad')->nullable();
                }
                if (!Schema::hasColumn('users', 'fecha_pausa')) {
                    $table->dateTime('fecha_pausa')->nullable();
                }
                if (!Schema::hasColumn('users', 'limite_de_anuncios')) {
                    $table->string('limite_de_anuncios')->nullable();
                }
                if (!Schema::hasColumn('users', 'tipo')) {
                    $table->string('tipo')->nullable();
                }
                if (!Schema::hasColumn('users', 'pagina_web')) {
                    $table->string('pagina_web')->nullable();
                }
                if (!Schema::hasColumn('users', 'plan')) {
                    $table->string('plan')->nullable();
                }
                if (!Schema::hasColumn('users', 'zone_id')) {
                    $table->unsignedBigInteger('zone_id')->nullable();
                    $table->foreign('zone_id')->references('id')->on('zones');
                }
                if (!Schema::hasColumn('users', 'ip_al_registrarse')) {
                    $table->string('ip_al_registrarse')->nullable();
                }
                if (!Schema::hasColumn('users', 'horario')) {
                    $table->string('horario')->nullable();
                }
                if (!Schema::hasColumn('users', 'whatsapp')) {
                    $table->string('whatsapp')->nullable();
                }
                if (!Schema::hasColumn('users', 'estado_wsp')) {
                    $table->enum('estado_wsp', ['Pendiente', 'Validado'])->default('Pendiente');
                }
                if (!Schema::hasColumn('users', 'codigo_ws')) {
                    $table->string('codigo_ws')->nullable();
                }
                if (!Schema::hasColumn('users', 'paso')) {
                    $table->integer('paso')->nullable();
                }
                if (!Schema::hasColumn('users', 'autovalidar')) {
                    $table->tinyInteger('autovalidar')->nullable();
                }
                if (!Schema::hasColumn('users', 'caducidad_de_cuenta')) {
                    $table->dateTime('caducidad_de_cuenta', $precision = 0)->nullable();
                }
                if (!Schema::hasColumn('users', 'remember_token')) {
                    $table->rememberToken();
                }
                if (!Schema::hasColumn('users', 'current_team_id')) {
                    $table->foreignId('current_team_id')->nullable();
                }
                if (!Schema::hasColumn('users', 'profile_photo_path')) {
                    $table->string('profile_photo_path', 2048)->nullable();
                }
                if (!Schema::hasColumn('users', 'deleted_at')) {
                    $table->softDeletes();
                }
                if (!Schema::hasColumn('users', 'created_at') || !Schema::hasColumn('users', 'updated_at')) {
                    $table->timestamps();
                }
            });
        } else {
            // Si la tabla no existe, la creamos completa
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No eliminamos la tabla, solo removemos columnas agregadas
        Schema::table('users', function (Blueprint $table) {
            $columnsToDrop = [
                'telefono', 'direccion', 'gps', 'provincia', 'presentacion', 'activo',
                'localidad', 'direccion_a_mostrar', 'codigo_video', 'fecha_de_nacimiento',
                'fecha_de_alta', 'fecha_caducidad', 'fecha_pausa', 'limite_de_anuncios',
                'tipo', 'pagina_web', 'plan', 'zone_id', 'ip_al_registrarse', 'horario',
                'whatsapp', 'estado_wsp', 'codigo_ws', 'paso', 'autovalidar', 'caducidad_de_cuenta'
            ];

            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }

            // Eliminar foreign key si existe
            if (Schema::hasColumn('users', 'zone_id')) {
                $table->dropForeign(['zone_id']);
            }
        });
    }
};