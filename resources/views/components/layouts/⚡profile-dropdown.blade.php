<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<el-dropdown class="relative">
    <button
        class="cursor-pointer relative flex max-w-xs items-center rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
        <span class="absolute -inset-1.5"></span>
        <span class="sr-only">Open user menu</span>
        @if (auth()->user()->image)
        <img src="{{ auth()->user()->image->url }}" alt="" class="relative size-8 rounded-full outline -outline-offset-1 outline-white/10" />
        @else
        <div class="relative z-40 text-gray-900 bg-white size-8 flex rounded-full font-semibold uppercase">
            <span class="m-auto">{{ auth()->user()->initials() }}</span>
        </div>
        @endif
    </button>

    <el-menu anchor="bottom end" popover
        class="w-48 origin-top-right rounded-md bg-gray-800 py-1 outline-1 -outline-offset-1 outline-white/10 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
        <a href="{{ route('users.show', auth()->user()->username) }}"
            class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:outline-hidden">Your profile</a>
        <a href="#" class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:outline-hidden">Settings</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:outline-hidden w-full text-left cursor-pointer">
                Sign out
            </button>
        </form>
    </el-menu>
</el-dropdown>