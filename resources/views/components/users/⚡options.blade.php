<?php

use App\Models\User;
use Livewire\Component;

new class extends Component
{
    public User $user;
};
?>

<div>
    {{-- Triger button --}}
    <button 
        @click="userOptions = true, modalBackdrop = true"
        class="fill-gray-100 cursor-pointer">
        <i class="ph-light ph-dots-three text-3xl"></i>
    </button>

    {{-- Modal --}}
    <div 
        @mousedown.outside="modalBackdrop = false, userOptions = false"
        x-transition
        x-show="userOptions"
        class="fixed top-1/2 left-1/2 -translate-1/2 bg-black/80 z-50 flex flex-col space-y-6 p-6 min-w-72 rounded-2xl text-gray-300">
        @if (auth()->id() !== $user->id)
        <div class="flex items-center space-x-3 cursor-pointer text-red-400 hover:text-red-500">
            <i class="ph-light ph-lock-key text-xl"></i>
            <span>Block</span>
        </div>
        @else
        <a 
            wire:navigate
            href="{{ route('accounts.edit') }}"
            class="flex items-center space-x-3 cursor-pointer hover:text-white">
            <i class="ph-light ph-pencil-simple text-xl"></i>
            <span>Edit profile</span>
        </a>
        @endif
        <div class="flex items-center space-x-3 cursor-pointer hover:text-white">
            <i class="ph-light ph-share text-xl"></i>
            <span>Share to</span>
        </div>
        <div class="flex items-center space-x-3 cursor-pointer hover:text-white">
            <i class="ph-light ph-info text-xl"></i>
            <span>About this account</span>
        </div>
        @if (auth()->id() !== $user->id)
        <div class="flex items-center space-x-3 cursor-pointer hover:text-white">
            <i class="ph-light ph-chat text-xl"></i>
            <span>Send message</span>
        </div>
        @endif
        <div 
            @mousedown="modalBackdrop = false, userOptions = false"
            class="flex items-center space-x-3 cursor-pointer hover:text-white">
            <i class="ph-light ph-x text-xl"></i>
            <span>Cancel</span>
        </div>
    </div>
</div>