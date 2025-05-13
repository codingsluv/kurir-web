<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_product' => $this->faker->sentence(3), // 3 kata
            'deskripsi' => $this->faker->paragraph(),
            'harga' => $this->faker->numberBetween(10000, 100000), // Harga antara 10000 dan 100000
            'kategori' => $this->faker->randomElement(['Kategori A', 'Kategori B', 'Kategori C']),
            'gambar' => 'gambar' . $this->faker->numberBetween(1, 10) . '.jpg', // Contoh nama gambar
        ];
    }
}
