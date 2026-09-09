<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// app/Models/WeddingWish.php
class WeddingWish extends Model
{
    protected $fillable = ['wedding_id', 'name', 'message'];

    public function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }
}
