<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'body',
        'excerpt',
        'is_published',
    ];

    /**
     * Get all of the post's visitors.
     */
    public function visitors(): MorphMany
    {

        return $this->morphMany(Visitor::class, 'visitable');
    }

    /**
     * Get all of the post's images.
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get the post's author.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The collections that belong to the post.
     */
    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(Collection::class);
    }

    /**
     * Get all of the post's claps.
     */
    public function claps(): MorphMany
    {
        return $this->morphMany(Clap::class, 'clappable');
    }

    /**
     * The tags that belong to the post.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get all of the post's comments.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
