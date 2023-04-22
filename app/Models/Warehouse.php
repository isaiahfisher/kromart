<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    public function inventory(): HasOne
    {
        return $this->hasOne(Inventory::class);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'warehouse_employees')->as('warehouse_employees')->using(WarehouseEmployee::class);
    }

    public function location(): hasOne
    {
        return $this->hasOne(Location::class);
    }

    public function stores(): hasMany
    {
        return $this->hasMany(Store::class);
    }
}
