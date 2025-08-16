<?php

namespace Database\Seeders;

use App\Models\Municipio;
use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       
    ### Las Palmas    
        $prov = Provincia::where('nombre', 'like', '%Palmas%')->first();
        Municipio::create(['nombre' => 'Telde', 'slug' => 'telde', 'provincia_id' => $prov->id]);
        $nombre = 'Las Palmas de Gran Canaria';
        Municipio::create(['nombre' => $nombre, 'slug' => Str::slug($nombre), 'provincia_id' => $prov->id]);
        $nombre = 'San Bartolomé de Tirajana';
        Municipio::create(['nombre' => $nombre, 'slug' =>  Str::slug($nombre), 'provincia_id' => $prov->id]);
       
        ### Lanzarote   
        $prov = Provincia::where('nombre', 'like', '%Lanzarote%')->first();        
        $nombre = 'Arrecife';
        Municipio::create(['nombre' => $nombre, 'slug' => Str::slug($nombre), 'provincia_id' => $prov->id]);
        $nombre = 'Teguise';
        Municipio::create(['nombre' => $nombre, 'slug' =>  Str::slug($nombre), 'provincia_id' => $prov->id]);
        $nombre = 'San Bartolomé (Lanzarote)';
        Municipio::create(['nombre' => $nombre, 'slug' =>  Str::slug($nombre), 'provincia_id' => $prov->id]);

        ### Fuerteventura   
        $prov = Provincia::where('nombre', 'like', '%Fuerteventura%')->first();
        $nombre = 'Puerto del Rosario';
        Municipio::create(['nombre' => $nombre, 'slug' => Str::slug($nombre), 'provincia_id' => $prov->id]);
        $nombre = 'La Oliva';
        Municipio::create(['nombre' => $nombre, 'slug' =>  Str::slug($nombre), 'provincia_id' => $prov->id]);
        $nombre = 'Pájara';
        Municipio::create(['nombre' => $nombre, 'slug' =>  Str::slug($nombre), 'provincia_id' => $prov->id]);     


    }
}
