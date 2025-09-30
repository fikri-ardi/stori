<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Clap extends Model
{
    /** @use HasFactory<\Database\Factories\ClapFactory> */
    use HasFactory;

    protected $fillable = [
        'count',
    ];

    /**
     * Get the user that owns the clap.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent clappable model (post, commment or other models).
     */
    public function clappable(): MorphTo
    {
        return $this->morphTo();
    }
}