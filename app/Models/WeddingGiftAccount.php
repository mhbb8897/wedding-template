<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeddingGiftAccount extends Model
{
    protected $fillable = [
        'wedding_id',
        'bank_name',
        'account_number',
        'account_holder',
        'logo',
    ];

    public function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }
}