<?php

use App\Models\Post;
use App\Models\Traits\Followable;
use Livewire\Component;

new class extends Component
{
    use Followable;
        
    public Post $post;

    public function toggleFollowUser()
    {
        $message = auth()->user()->toggleFollow($this->post->author);
        $this->dispatch('notif', message: $message);
        $this->dispatch('follow-updated');
    }
};
?>

<div x-data="{
    Options: false,
    }" 
    class="relative">

    {{-- Post option trigger button --}}
    <a @click="Options = true" class="cursor-pointer flex items-center hover:text-white transition">
        <i class="ph-bold ph-dots-three text-2xl"></i>
    </a>

    {{-- Post option modal --}}
    <div x-show="Options" @mousedown.outside="Options = false" x-transition
        class="absolute min-w-40  bg-black/90 backdrop-blur-lg rounded-2xl top-full mt-2 left-1/2 -translate-x-1/2 text-nowrap z-50">

        {{-- Share Post Modal --}}
        <div class="p-5 flex flex-col space-y-5 text-sm text-gray-300">
            @if (auth()->id() == $post->author->id)
            <a 
                wire:navigate
                href="{{ route('posts.edit', $post) }}"
                class="flex items-center space-x-3 hover:text-white cursor-pointer">
                <i class="ph-light ph-pen text-xl"></i>
                <div>Edit post</div>
            </a>
            <button class="flex items-center space-x-3 hover:text-white cursor-pointer">
                <i class="ph-light ph-chart-bar text-xl"></i>
                <div>Post stats</div>
            </button>
            <livewire:posts.delete :$post />
            @else
            <button
                @mousedown="Options = false, $wire.toggleFollowUser()"
                class="flex items-center space-x-3 hover:text-white cursor-pointer">
                <i class="ph-light ph-user-{{ auth()->user()->isFollowing($post->author) ? 'minus' : 'plus' }} text-xl"></i>
                <div>{{ auth()->user()->isFollowing($post->author) ? 'Unfollow' : 'Follow' }} author</div>
            </button>
            <a 
                class="flex items-center space-x-3 hover:text-white cursor-pointer">
                <i class="ph-light ph-file-magnifying-glass text-xl"></i>
                <div>Post info</div>
            </a>
            <a 
                class="flex items-center space-x-3 text-red-400 hover:text-red-500 cursor-pointer">
                <i class="ph-light ph-flag text-xl"></i>
                <div>Report post</div>
            </a>
            @endif
        </div>
    </div>
</div>