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
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(2),
            'price' => $this->faker->randomFloat(2, 5, 500), // $5.00 – $500.00
//            'image' => $this->faker->imageUrl(640, 480, 'products', true), // Placeholder image
        ];
    }
}
