<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Formapago;

class FormaPagosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Formapago::create(['nombre' => 'Efectivo', 'slug'=>'efectivo']);
        Formapago::create(['nombre' => 'Tarjeta', 'slug' => 'tarjeta']);
        Formapago::create(['nombre' => 'Paypal', 'slug' => 'paypal']);
        Formapago::create(['nombre' => 'Bizum', 'slug' => 'bizum']);
        
    }
}
