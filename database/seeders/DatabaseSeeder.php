<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Item;
use App\Models\Inventory;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Employee::factory()->count(5)->forLocation()->create();
        Inventory::factory()->count(5)->create();
        $items = Item::factory()->count(5)->hasAttached(Inventory::factory()->count(4),
            [
                'quantity' => random_int(1,100),
                'aisle' => random_int(1,20),
                'shelf' => chr(rand(65,90)),
                'batch' => Str::uuid(),
                'expiry_date' => date('Y-m-d', strtotime("+1 week"))
            ]
        )->forManufacturer()->make();
        foreach ($items as $item)
            $item->save();
    }
}
