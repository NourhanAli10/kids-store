<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url' => $this->faker->imageUrl(640, 480, 'products', true), // Generates a random image URL
            'alt' => $this->faker->sentence(3), // Generates a short description for the image
            'product_id' => \App\Models\Product::factory(), // Assumes you have a Product model and factory
        ];
    }
}
