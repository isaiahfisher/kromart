<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreEmployee extends Pivot
{
    use HasFactory;
    protected $table = 'store_employees';
    public $incrementing = true;

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
