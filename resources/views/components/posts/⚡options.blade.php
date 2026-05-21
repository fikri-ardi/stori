<?php

use App\Models\Post;
use Livewire\Component;

new class extends Component
{
    public Post $post;
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
        class="absolute min-w-40  bg-black/90 backdrop-blur-lg rounded-2xl top-full mt-2 left-1/2 -translate-x-1/2 text-nowrap">

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
            <button class="flex items-center space-x-3 hover:text-red-500 cursor-pointer text-red-400">
                <i class="ph-light ph-trash text-xl"></i>
                <div>Delete post</div>
            </button>
            @else
            <a 
                class="flex items-center space-x-3 hover:text-white cursor-pointer">
                <i class="ph-light ph-user-plus text-xl"></i>
                <div>Follow author</div>
            </a>
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