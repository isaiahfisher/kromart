<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Item;
use App\Models\Inventory;
use App\Models\Courier;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Manufacturer;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\Store;
use App\Models\Warehouse;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++)
        {
            Location::factory()->count(1)->has(
                Warehouse::factory()->count(5)->has( 
                    Employee::factory()->count(25)->for(
                        Location::factory()
                    )
                )->has(
                    Inventory::factory()->count(1)->has(
                        Promotion::factory()->count(1)
                    )->hasAttached(
                        Item::factory()->count(10)->for(Manufacturer::factory()),
                        [
                            'quantity' => random_int(1,100),
                            'aisle' => random_int(1,10),
                            'shelf' => chr(rand(65,90)),
                            'batch' => Str::uuid(),
                            'expiry_date' => date('Y-m-d', strtotime('+1 week')),
                        ]
                    )
                )
            )->has(
                Store::factory()->count(15)->has(
                    Employee::factory()->count(10)->for(
                        Location::factory()
                    )
                )->for(
                    Warehouse::inRandomOrder()->first()
                )->has(
                    Promotion::factory()->count(2)
                )
            )->has(
                Promotion::factory()->count(4)
            )->has(
                Customer::factory()->count(10)->has(
                    Order::factory()->count(10)
                )
            )->create();
            Courier::factory()->count(5)->has(Service::factory()->count(10))->create();
        }
    }
}
