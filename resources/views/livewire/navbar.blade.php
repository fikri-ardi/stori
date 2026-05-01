<nav x-data class="bg-gray-800/50">
    @if (!request()->routeIs('posts.create') && !request()->routeIs('posts.edit'))
        {{-- Desktop Nav --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                {{-- Left nav --}}
                <div class="flex items-center">
                    <div class="shrink-0">
                        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" class="size-8" />
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <!-- Current: "bg-gray-950/50 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
                            <x-nav-link href="{{ route('home') }}">Home</x-nav-link>
                            <x-nav-link href="{{ route('posts.index') }}">Posts</x-nav-link>
                            <x-nav-link href="{{ route('tags.index') }}">Explore</x-nav-link>
                            <x-nav-link href="{{ route('about') }}">About</x-nav-link>
                            <x-nav-link href="{{ route('contact') }}">Contact</x-nav-link>
                        </div>
                    </div>
                </div>
        
                {{-- Right nav --}}
                @auth
                <div class="hidden md:block">
                    <div class="ml-4 flex space-x-6 items-center md:ml-6">
                        {{-- Create post button --}}
                        <a href="{{ route('posts.create') }}" class="flex items-center space-x-2 text-sm text-gray-300 hover:text-white">
                            <i class="ph-light ph-note-pencil text-2xl"></i>
                            <span>Write</span>
                        </a>
        
                        {{-- Notification button --}}
                        <button type="button"
                            class="relative rounded-full p-1 text-gray-400 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">View notifications</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                <path
                                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
        
                        <!-- Profile dropdown toggler -->
                        @auth
                        <livewire:layouts.profile-dropdown />
                        @endauth
                    </div>
                </div>
                @else
                <a wire:navigate href="{{ route('login') }}" class="bg-gray-200 text-gray-800 rounded-full px-4 py-2 text-sm font-semibold">Login</a>
                @endauth
        
                {{-- Hamburger button --}}
                <div class="-mr-2 flex md:hidden">
                    <!-- Mobile menu button -->
                    <button type="button" command="--toggle" commandfor="mobile-menu"
                        class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true"
                            class="size-6 in-aria-expanded:hidden">
                            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true"
                            class="size-6 not-in-aria-expanded:hidden">
                            <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        {{-- Mobile Nav --}}
        <el-disclosure id="mobile-menu" hidden class="block md:hidden">
            <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                <!-- Current: "bg-gray-950/50 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
                <x-nav-link href="{{ route('home') }}">Home</x-nav-link>
                <x-nav-link href="{{ route('posts.index') }}">Posts</x-nav-link>
                <x-nav-link href="{{ route('about') }}">About</x-nav-link>
                <x-nav-link href="{{ route('contact') }}">Contact</x-nav-link>
            </div>
            <div class="border-t border-white/10 pt-4 pb-3">
                <div class="flex items-center px-5">
                    <div class="shrink-0">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="" class="size-10 rounded-full outline -outline-offset-1 outline-white/10" />
                    </div>
                    <div class="ml-3">
                        <div class="text-base/5 font-medium text-white">Tom Cook</div>
                        <div class="text-sm font-medium text-gray-400">tom@example.com</div>
                    </div>
                    <button type="button"
                        class="relative ml-auto shrink-0 rounded-full p-1 text-gray-400 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">View notifications</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                            <path
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Your
                        profile</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Settings</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Sign
                        out</a>
                </div>
            </div>
        </el-disclosure>
        
    @else
    <div class="flex items-center justify-between px-32 py-4 text-gray-200">
        {{-- Left --}}
        <div class="flex items-center space-x-3">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="text-3xl font-bold">Verse</a>

            {{-- Post status --}}
            <div class="flex items-center space-x-3 text-sm">
                <div>Draft</div>
                @if (request()->routeis('posts.edit'))
                <div>Saved</div>
                @endif
            </div>
        </div>

        {{-- Right --}}
        <div class="flex items-center space-x-5">
            {{-- Publish button --}}
            <button 
                @disabled(!request()->routeIs('posts.edit')) 
                @class([
                    'text-xs bg-green-600 px-3 py-1.5 rounded-full cursor-pointer font-semibold',
                    'opacity-50 cursor-not-allowed' => !request()->routeIs('posts.edit'),
                ])
                @click="$dispatch('publish')"
                class="text-xs bg-green-600 px-3 py-1.5 rounded-full cursor-pointer font-semibold">Publish</button>

            
            {{-- More actioon --}}
            <button class="ph-bold ph-dots-three text-2xl cursor-pointer"></button>

            {{-- Notification --}}
            <button class="ph-light ph-bell-simple text-xl cursor-pointer"></button>

            <!-- Profile dropdown toggler -->
            @auth
            <livewire:layouts.profile-dropdown />
            @endauth
        </div>
    </div>
    @endif
</nav>
