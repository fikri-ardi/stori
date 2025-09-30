<?php

namespace App\Models\Traits;

use App\Models\User;

trait Followable
{
    /**
     * Get all the followed user.
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id')->withTimestamps();
    }

    /**
     * Get all the followers.
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id')->withTimestamps();
    }

    /**
     * Follow the given user.
     */
    public function follow(User $user)
    {
        return $this->followings()->attach($user->id);
    }

    /**
     * Unfollow the given user.
     */
    public function unfollow(User $user)
    {
        return $this->followings()->detach($user->id);
    }

    /**
     * Check if the current user is following the given user.
     */
    public function isFollowing(User $user)
    {
        return $this->followings()->where('followed_id', $user->id)->exists();
    }

    /**
     * Check if the current user is followed by the given user.
     */
    public function isFollowedBy(User $user)
    {
        return $this->followers()->where('follower_id', $user->id)->exists();
    }
}