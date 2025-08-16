<?php

namespace Database\Factories;
use Faker\Generator as Faker; 
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Imagen;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Imagen>
 */
class ImagenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $num = rand(1,50);
        return [
            #'url'=> 'http://placeimg.com/640/480/any' . $num,
            'nombre'=>$this->faker->imageUrl('public/storage/images/anuncio/', 640, 480, null, false),
            
        ];
    }
}
