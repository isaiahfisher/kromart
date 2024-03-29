<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class WarehouseEmployee extends Pivot
{
    use HasFactory;
    protected $table = 'warehouse_employees';
    public $incrementing = true;
}
