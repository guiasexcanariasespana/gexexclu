<?php

namespace Database\Seeders;

use App\Models\Lugar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LugarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Lugar::create(['nombre' => 'Domicilio Cliente', 'slug' => 'domicilio-cliente']);
        Lugar::create(['nombre' => 'Domicilio Propio', 'slug' => 'domicilio-propio']);
        Lugar::create(['nombre' => 'Hotel', 'slug' => 'hotel']);
        Lugar::create(['nombre' => 'Salidas Eventos', 'slug' => 'salidas-eventos']);
        Lugar::create(['nombre' => 'Acompañante', 'slug' => 'acompanante']);
        Lugar::create(['nombre' => 'Cam (Videollamada )', 'slug' => 'cam-videollamada']);
        Lugar::create(['nombre' => 'Efectivo', 'slug' => 'efectivo']);
     
    }
}
