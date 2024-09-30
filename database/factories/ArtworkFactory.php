<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artwork>
 */
class ArtworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->sentences(2, true),
            'image' => $this->faker->imageUrl(),
            'featured' => $this->faker->boolean(),
            'original' => $this->faker->boolean(),
            'original_price' => $this->faker->numberBetween (150, 1000),
            'original_dimensions' => $this->faker->words(3, true),
            'original_substrate' => $this->faker->words(2, true),
            'search_tags' => $this->faker->words(4, true),
            'medium' => $this->faker->randomElement(['Digital Art', 'Mixed Media', 'Oil Painting', 'Watercolor', 'Acrylic Painting', 'Oil Pastel', 'Soft Pastel', 'Charcoal', 'Graphite', 'Color Pencil', 'Ink', 'Alcohol Marker', 'Other']),

        ];
    }
}
