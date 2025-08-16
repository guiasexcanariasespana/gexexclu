<?php

namespace Database\Seeders;
use App\Models\Imagen;
use App\Models\Anuncio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnunciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $anuncios = Anuncio::factory(12)->create();

        foreach($anuncios as $anuncio){
            Imagen::factory(1)->create([
                'anuncio_id'=> $anuncio->id,
                'user_id'=> $anuncio->user->id,
                'position'=> 1,
               
            ]);
            
        }


    }
}
