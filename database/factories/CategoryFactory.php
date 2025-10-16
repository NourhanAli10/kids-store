<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word, // Generates a random word for the category name
            'slug' => $this->faker->unique()->slug, // Generates a unique slug
            'created_by' => $this->faker->name, // Generates a random name for the creator
            'status' => $this->faker->randomElement(['available', 'unavailable']), // Randomly picks a status
            'image' => $this->faker->imageUrl(640, 480, 'business', true), // Generates a random image URL
            'parent_id' => null, // Default to no parent (top-level category)
        ];
    }
}
