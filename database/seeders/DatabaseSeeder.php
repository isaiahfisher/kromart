<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Item;
use App\Models\Inventory;
use App\Models\InventoryItem;
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
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        for ($i = 0; $i < 100; $i++)
        {

            $location = Location::factory()->count(1)->create()[0];
            $warehouse = Warehouse::factory()->count(1)->for($location)->has(
                Employee::factory()->count(75)->state(
                    [
                        'location_id' => Location::factory()->state(
                            [
                                'city' => $location->city,
                                'state' => $location->state,
                                'country' => $location->country
                            ]
                        )
                    ]
                )
            )->has(
                Inventory::factory()->count(1)->hasAttached(
                    Item::factory()->count(500)->state([
                        'manufacturer_id' => Manufacturer::factory()->state([
                            'location_id' => Location::factory()->state([
                                'city' => $location->city,
                                'state' => $location->state,
                                'country' => $location->country
                            ])
                        ])
                    ]),
                    fn() => [
                        'quantity' => random_int(1,100),
                        'aisle' => random_int(1,10),
                        'shelf' => chr(rand(65,90)),
                        'batch' => Str::uuid(),
                        'expiry_date' => now()->addDays(rand(0, now()->diffInDays(now()->addMonths(1))))
                    ]
                )
            )->create()[0];

            Store::factory()->count(2)->for($warehouse)->state(
                [
                    'location_id' => Location::factory()->state(
                        [
                            'city' => $location->city,
                            'state' => $location->state,
                            'country' => $location->country
                        ]
                    )
                ]
            )->has(
                Employee::factory()->count(30)->state(
                    [
                        'location_id' => Location::factory()->state(
                            [
                                'city' => $location->city,
                                'state' => $location->state,
                                'country' => $location->country
                            ]
                        )
                    ]
                )
            )->has(
                Inventory::factory()->count(1)->hasAttached(
                    Item::factory()->count(100)->state([
                        'manufacturer_id' => Manufacturer::factory()
                    ]),
                    fn() => [
                        'quantity' => random_int(1,100),
                        'aisle' => random_int(1,10),
                        'shelf' => chr(rand(65,90)),
                        'batch' => Str::uuid(),
                        'expiry_date' => now()->addDays(rand(0, now()->diffInDays(now()->addMonths(1))))
                    ]
                )
            )->create();

            Customer::factory()->count(100)->state(
                [
                    'location_id' => Location::factory()->state([
                        'city' => $location->city,
                        'state' => $location->state,
                        'country' => $location->country
                    ])
                ])->has(
                    Order::factory()->count(5)->hasAttached(
                        InventoryItem::inRandomOrder()->limit(rand(1,15))->get(),
                        fn() => ['quantity' => rand(1, 10)]
                    )
                )->create();

            Courier::factory()->count(5)->has(Service::factory()->count(10))->create();
        }
    }
}
