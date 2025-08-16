<?php

namespace Database\Seeders;
use App\Models\Imagen;
use App\Models\Anuncio;
use App\Models\Plane;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
class AnuncioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //     Plane::create(['nombre'=>'ORO 30',
    //     'slug' => Str::slug('ORO 30'),
    //     'dias'=>'30',
    //     'clase_id'=>6,
    //     'categoria_id'=>1      ]
    //    );
        
        Anuncio::factory(100)->create();
        
        
            
        
        
    }    
}
