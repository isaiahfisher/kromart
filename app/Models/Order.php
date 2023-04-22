<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function inventory_items(): BelongsToMany
    {
        return $this->belongsToMany(InventoryItem::class, 'order_inventory_items')->as('order_inventory_items')->using(OrderInventoryItem::class);
    }
}
