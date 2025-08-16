<?php

namespace Database\Seeders;

use App\Models\Municipio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Zone;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ### Las Palmas    
        $muni = Municipio::where('nombre', 'like', '%San Bartolomé de Tirajana%')->first();        
        $nombre = 'Playa del Inglés';
        Zone::create(['nombre' => $nombre, 'slug' => Str::slug($nombre), 'municipio_id' => $muni->id]);
      
    }
}
