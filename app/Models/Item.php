<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function inventories(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'inventory_item')->withPivot('quantity', 'aisle', 'shelf', 'batch', 'expiry_date')->as('inventory_item')->using(InventoryItem::class)->withTimestamps();
    }
}
