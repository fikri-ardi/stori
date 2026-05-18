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

    {{-- Post option button --}}
    <a @click="Options = true" class="cursor-pointer">
        <i class="ph-light ph-dots-three text-2xl"></i>
    </a>

    {{-- Post option post modal --}}
    <div x-show="Options" @mousedown.outside="Options = false" x-transition
        class="absolute min-w-40  bg-black/90 backdrop-blur-lg rounded-2xl top-full mt-2 left-1/2 -translate-x-1/2 text-nowrap">

        {{-- Share Post Modal --}}
        <div class="p-5 flex flex-col space-y-5 text-sm text-gray-300">
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
            </a>
        </div>
    </div>
</div>