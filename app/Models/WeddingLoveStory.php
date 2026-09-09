<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeddingLoveStory extends Model
{
    protected $fillable = ['wedding_id', 'order', 'label', 'title', 'content'];

    public function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }
}