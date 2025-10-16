<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company, // Generates a random company name
            'image' => $this->faker->imageUrl(640, 480, 'business', true), // Generates a random image URL
            'slug' => $this->faker->unique()->slug, // Generates a unique slug
            'created_by' => $this->faker->name, // Generates a random name for the creator
            'status' => $this->faker->randomElement(['available', 'unavailable']), // Randomly picks a status
        ];
    }
}
