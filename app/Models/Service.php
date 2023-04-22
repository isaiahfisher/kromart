<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class);
    }
}
