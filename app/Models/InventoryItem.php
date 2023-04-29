<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InventoryItem extends Pivot
{
    use HasFactory;

    public $incrementing = true;
    public $table = 'inventory_item';
    public $fillable = [];

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_inventory_items', 'inventory_item_id', 'order_id')->as('order_inventory_items')->using(OrderInventoryItem::class)->withTimestamps();
    }

}
