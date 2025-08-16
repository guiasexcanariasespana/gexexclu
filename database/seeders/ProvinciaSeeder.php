<?php

namespace Database\Seeders;

use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provincia::create(['nombre' => 'Las Palmas', 'slug' => 'las-palmas']);
        Provincia::create(['nombre' => 'Lanzarote', 'slug' => 'lanzarote']);
        Provincia::create(['nombre' => 'Fuerteventura', 'slug' => 'fuerteventura']);
    }
}
