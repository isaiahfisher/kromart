<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;
use App\Models\Warehouse;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = random_int(1,3);
        $store = null;
        $warehouse = null;

        if ($type === 1 || $type === 3)
        {
            $store = Store::factory()->count(1)->make()[0];
            $store->save();
        }

        if ($type === 2 || $type === 3)
        {
            $warehouse = Warehouse::factory()->count(1)->make()[0];
            $warehouse->save();
        }
        return [
            'store_id' => ($store) ? ($store->id) : null,
            'warehouse_id' => ($warehouse) ? ($warehouse->id) : null
        ];
    }
}
