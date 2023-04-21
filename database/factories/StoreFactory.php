<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Warehouse;
use App\Models\Location;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $warehouse = Warehouse::factory()->count(1)->make()[0];
        $warehouse->save();

        $location = Location::factory()->count(1)->make()[0];
        $location->save();

        return [
            'name' => fake()->company(),
            'status' => fake()->randomElement(['active', 'maintenance', 'inactive']),
            'warehouse_id' => $warehouse->id,
            'location_id' => $location->id
        ];
    }
}
