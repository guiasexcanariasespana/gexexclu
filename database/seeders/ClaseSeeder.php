<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clase;

class ClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clase::create(['id' => '11', 'nombre' => 'DIAMANTE', 'slug' => 'diamante', 'color'=> '#8cbccb']);
        Clase::create(['id' => '6', 'nombre' => 'ORO', 'slug' => 'oro', 'color' => '#d6bc4f']);
        Clase::create(['id' => '7', 'nombre' => 'PLATA', 'slug' => 'plata', 'color' => '#b1b1b1']);
        Clase::create(['id' => '8', 'nombre' => 'BRONCE', 'slug' => 'bronce', 'color' => '#906f3a']);
        Clase::create(['id' => '9', 'nombre' => 'NORMAL', 'slug' => 'normal', 'color' => '#a21717']);
    }
}
