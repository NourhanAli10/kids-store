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
           'name' => $this->faker->words(3, true), // Generates a 3-word product name
            'description' => $this->faker->paragraph, // Generates a random paragraph
            'price' => $this->faker->randomFloat(2, 10, 1000), // Generates a price between 10 and 1000
            'slug' => $this->faker->unique()->slug, // Generates a unique slug
            'created_by' => $this->faker->name, // Generates a random name for the creator
            'status' => $this->faker->randomElement(['in_stock', 'out_of_stock']), // Randomly picks a status
            'category_id' => \App\Models\Category::factory(), // Assumes you have a Category model and factory
            'brand_id' => \App\Models\Brand::factory(), // Assumes you have a Brand model and factory
        ];
    }
}
