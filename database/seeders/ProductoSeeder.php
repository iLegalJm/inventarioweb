<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Productofoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $productos = Producto::factory(50)->create();

        foreach ($productos as $producto) {
            Productofoto::factory(1)->create([
                'producto_id' => $producto->id
            ]);
        }
    }
}