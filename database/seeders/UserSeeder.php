<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'José Martín',
            'email' => 'josemcz2211@gmail.com',
            'password' => bcrypt('..Admin2023')
        ])->assignRole('admin');

        User::create([
            'name' => 'Bryan',
            'email' => 'bryan@gmail.com',
            'password' => bcrypt('..Admin2023')
        ])->assignRole('admin');

        User::create([
            'name' => 'Gabriel',
            'email' => 'gabriel@gmail.com',
            'password' => bcrypt('..Admin2023')
        ])->assignRole('admin');

        User::create([
            'name' => 'Raquel',
            'email' => 'raquel@gmail.com',
            'password' => bcrypt('..Admin2023')
        ])->assignRole('admin');

        User::factory(20)->create();
    }
}