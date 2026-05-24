<?php

use App\Models\Traits\Followable;
use App\Models\User;
use Livewire\Component;

new class extends Component
{
    use Followable;
    
    public User $user;

    public function followUser()
    {
        if (! auth()->check()) {
            $this->dispatch('open-login-modal');
            return;
        }

        auth()->user()->follow($this->user);
        $this->dispatch('notif', message: "You are now following {$this->user->name}");
    }

    public function unfollowUser()
    {
        if (! auth()->check()) {
            $this->dispatch('open-login-modal');
            return;
        }

        auth()->user()->unfollow($this->user);
        $this->dispatch('notif', message: "You are no longer following {$this->user->name}");
    }
};
?>

<div 
    @follow-updated.window="$wire.$refresh()"
    class="inline-flex">
    @if (auth()->user()?->isFollowing($user))
        <button
            type="button"
            wire:click="unfollowUser"
            wire:loading.attr="disabled"
            wire:target="unfollowUser"
            class="inline-flex h-9 min-w-24 cursor-pointer items-center justify-center gap-2 rounded-full border border-white/15 bg-white px-4 text-sm font-semibold text-gray-950 transition duration-150 hover:bg-gray-200 active:scale-[0.98] disabled:pointer-events-none disabled:opacity-70">
            <i wire:loading.remove wire:target="unfollowUser" class="ph-fill ph-check-circle text-lg"></i>
            <i wire:loading wire:target="unfollowUser" class="ph-light ph-spinner-gap text-lg animate-spin"></i>

            <span wire:loading.remove wire:target="unfollowUser">Following</span>
            <span wire:loading wire:target="unfollowUser">...</span>
        </button>
    @else
        <button
            type="button"
            wire:click="followUser"
            wire:loading.attr="disabled"
            wire:target="followUser"
            class="inline-flex h-9 min-w-24 cursor-pointer items-center justify-center gap-2 rounded-full border border-white/15 bg-white/[0.04] px-4 text-sm font-semibold text-gray-200 transition duration-150 hover:border-white/25 hover:bg-white/[0.08] hover:text-white active:scale-[0.98] disabled:pointer-events-none disabled:opacity-70">
            <i wire:loading.remove wire:target="followUser" class="ph-light ph-user-plus text-lg"></i>
            <i wire:loading wire:target="followUser" class="ph-light ph-spinner-gap text-lg animate-spin"></i>

            <span wire:loading.remove wire:target="followUser">Follow</span>
            <span wire:loading wire:target="followUser">...</span>
        </button>
    @endif
</div>
