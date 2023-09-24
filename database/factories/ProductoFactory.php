<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Producto::class;

    public function definition(): array
    {
        return [
            'codigo' => $this->faker->text(15),
            'precioventa' => $this->faker->randomFloat(4, 50, 100),
            'nombre' => 'Producto' . rand(1, 500),
            'descripcion' => $this->faker->text(50),
            'marca' => $this->faker->randomElement(['asus', 'asd']),
            'modelo' => $this->faker->randomElement(['bxccxcc', 'wwewewe']),
            'tamaño' => $this->faker->randomElement(['42x25', '25x25']),
            'color' => $this->faker->safeColorName(),
            'stock' => rand(3, 5),

        ];
    }
}