<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'sku' => fake()->regexify('[A-Z0-9]{4}[-]{1}[0-9]'),
            'description' => fake()->paragraph(),
            'category' => fake()->colorName(),
            'msrp' => fake()->randomFloat(2, 0, 1000000)
        ];
    }
}
