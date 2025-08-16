<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
            'name' => 'Claudio',
            'email' => 'claudio670531643@gmail.com',
            'password' =>  bcrypt('12345678'),
        ])->assignRole('Admin');
       
        User::create([
            'name' => 'pepe',
            'email' => 'p@p.com',
            'password' =>  bcrypt('12345678'),
        ])->assignRole('Inicial');
       
    }
}
