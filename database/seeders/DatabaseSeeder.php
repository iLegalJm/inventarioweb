<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Producto;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* `Storage::makeDirectory('productos');` está creando un nuevo directorio llamado 'productos'
        en el directorio de almacenamiento de la aplicación. Normalmente se utiliza para crear un
        directorio para almacenar archivos u otros recursos relacionados con la aplicación. */
        Storage::makeDirectory('productos');

        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(AlmacenSeeder::class);
        $this->call(ProductoSeeder::class);
    }
}