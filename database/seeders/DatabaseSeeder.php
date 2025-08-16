<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Zone;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //Storage::deleteDirectory('/public/productos');
        //$filepath = storage_path('producto2');

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FormaPagosSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ClaseSeeder::class);
        $this->call(LugarSeeder::class);
        $this->call(ProvinciaSeeder::class);
        $this->call(MunicipioSeeder::class);
        $this->call(ZoneSeeder::class);

      

    }
}
