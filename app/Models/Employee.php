<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class)->using(WarehouseEmployee::class);
    }

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class)->using(StoreEmployee::class);
    }
}
