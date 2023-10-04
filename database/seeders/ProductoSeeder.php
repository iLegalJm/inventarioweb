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
        
        /* ` = Producto::factory(10)->create();` es crear 10 instancias del modelo `Producto`
        usando una fábrica y guardarlas en la base de datos. La llamada al método `factory(10)`
        especifica que se deben crear 10 instancias, y la llamada al método `create()` guarda las
        instancias en la base de datos. */
        $productos = Producto::factory(10)->create();

        foreach ($productos as $producto) {
            Productofoto::factory(1)->create([
                'producto_id' => $producto->id
            ]);
        }
    }
}