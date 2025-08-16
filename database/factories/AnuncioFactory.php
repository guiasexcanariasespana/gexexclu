<?php

namespace Database\Factories;
use App\Models\Anuncio;
use Illuminate\Support\Str;
use App\Models\Plane;
use App\Models\Categoria;
use App\Models\Clase;
use App\Models\User;
use App\Models\Provincia;
use App\Models\Municipio;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anuncio>
 */
class AnuncioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->word(20);
            $plan= Plane::all()->random();
            return [
                'user_id'=> User::all()->random()->id,
                'nombre'=> $name,
                'slug'=> Str::slug($name), 
                'titulo'=> $this->faker->text(150),
                'presentacion'=> $this->faker->text(250),
                'tipo'=> $this->faker->randomElement(['Normal','Doble']), 
                'orientacion'=> $this->faker->randomElement(['Heterosexual','Bisexual', 'Homosexual','Otra']),
                'telefono' => '345678798',  
                'categoria_id' =>$plan->categoria_id,
                'clase_id' =>$plan->clase_id, 
                'provincia_id' =>Provincia::all()->random()->id, 
                'municipio_id' =>Municipio::all()->random()->id,
                'zone_id' =>Zone::all()->random()->id, 
                'plane_id' =>$plan->id,
                'precio'=> $plan->precio,
                'dias'=> $plan->dias,
                'telefono'=> $this->faker->text(15),
                'localidad'=> 'Las Palmas',
                'fecha_nacimiento' => '2022-11-30',
                'edad' => '44',
                'Nacionalidad'=> 'ESP',
                'estado' =>$this->faker->randomElement(['Borrador', 'Publicado', 'Pausado', 'Finalizado', 'Suspendido', 'Rechazado']),
                'fecha_de_publicacion' => '2022-11-30',
                'fecha_caducidad' => '2022-11-30',                
                'verificacion' =>$this->faker->randomElement(['Pendiente', 'Si', 'Rechazado']),
            ];
    }
}
