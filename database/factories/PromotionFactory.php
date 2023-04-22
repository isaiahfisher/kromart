<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $promotion_type = fake()->randomElement(['flat', 'percent', 'bogo']);
        return [
            'promotion_type' => $promotion_type,
            'promotional_region' => fake()->optional($weight = .9)->randomElement(['city', 'state', 'country']),
            'flat' => ($promotion_type == 'flat') ? fake()->randomFloat(2, 1, 15) : null,
            'percent' => ($promotion_type == 'percent') ? fake()->randomFloat(2, 10, 90) : null
        ];
    }
}
