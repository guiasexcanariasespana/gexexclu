<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create(['id'=>'1', 'nombre' => 'Chicas', 'slug' => 'chicas']);
        Categoria::create(['id' => '4', 'nombre' => 'Transexuales', 'slug' => 'transexuales']);
        Categoria::create(['id' => '7', 'nombre' => 'Masajes', 'slug' => 'masajes']);
        Categoria::create(['id' => '8', 'nombre' => 'Chicos', 'slug' => 'chicos']);
        // Categoria::create(['id' => '13', 'nombre' => 'Banner Grande Destacados Chicas', 'slug' => 'banner-grande-destacados-chicas']);
        // Categoria::create(['id' => '14', 'nombre' => 'Banner Grande Destacados Transexuales', 'slug' => 'banner-grande-destacados-transexuales']);
        // Categoria::create(['id' => '15', 'nombre' => 'Banner Grande Destacados Chicos', 'slug' => 'banner-grande-destacados-chicos']);
        // Categoria::create(['id' => '16', 'nombre' => 'Banner Grande Destacados Masajes', 'slug' => 'banner-grande-destacados-masajes']);

    }
}
