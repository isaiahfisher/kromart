<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function warehouses(): hasMany
    {
        return $this->hasMany(Warehouse::class);
    }

    public function stores(): hasMany
    {
        return $this->hasMany(Store::class);
    }

    public function promotions(): hasMany
    {
        return $this->hasMany(Promotion::class);
    }

    public function customers(): hasMany
    {
        return $this->hasMany(Customer::class);
    }
}
