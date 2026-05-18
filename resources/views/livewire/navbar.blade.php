<nav>
    @if (!request()->routeIs('posts.create') && !request()->routeIs('posts.edit'))
        @php
            $navItems = [
                [
                    'label' => 'Home',
                    'href' => route('home'),
                    'icon' => 'ph-house',
                    'active' => request()->routeIs('home'),
                ],
                [
                    'label' => 'Posts',
                    'href' => route('posts.index'),
                    'icon' => 'ph-article',
                    'active' => request()->routeIs('posts.*'),
                ],
                [
                    'label' => 'Explore',
                    'href' => route('tags.index'),
                    'icon' => 'ph-compass',
                    'active' => request()->routeIs('tags.*'),
                ],
                [
                    'label' => 'About',
                    'href' => route('about'),
                    'icon' => 'ph-info',
                    'active' => request()->routeIs('about'),
                ],
                [
                    'label' => 'Contact',
                    'href' => route('contact'),
                    'icon' => 'ph-envelope-simple',
                    'active' => request()->routeIs('contact'),
                ],
            ];
        @endphp

        {{-- Fixed top bar --}}
        <header class="fixed inset-x-0 top-0 z-50 border-b border-white/10 bg-gray-950/55 backdrop-blur-2xl supports-[backdrop-filter]:bg-gray-950/35">
            <div class="flex h-16 items-center gap-4 px-4 sm:px-6 lg:px-8">
                <a wire:navigate href="{{ route('home') }}" class="flex shrink-0 items-center gap-2 text-white">
                    <span class="grid size-9 place-items-center rounded-full border border-white/10 bg-white/10 text-lg font-bold shadow-lg shadow-black/20">V</span>
                    <span class="text-xl font-semibold tracking-normal">Verse</span>
                </a>

                <form action="{{ route('search') }}" method="GET" class="mx-auto flex w-full max-w-xl items-center">
                    <label for="top-search" class="sr-only">Search</label>
                    <div class="flex h-11 w-full items-center gap-3 rounded-full border border-white/10 bg-white/[0.07] px-4 text-gray-300 shadow-lg shadow-black/10 backdrop-blur-xl transition focus-within:border-white/25 focus-within:bg-white/[0.1]">
                        <i class="ph-light ph-magnifying-glass text-xl"></i>
                        <input
                            id="top-search"
                            name="keywords"
                            type="search"
                            value="{{ request('keywords') }}"
                            placeholder="Search"
                            class="h-full min-w-0 flex-1 bg-transparent text-sm text-white placeholder:text-gray-500 outline-none"
                        >
                    </div>
                </form>
            </div>
        </header>

        {{-- Medium-like fixed sidebar --}}
        <aside class="fixed left-0 top-16 bottom-0 z-40 hidden w-20 border-r border-white/10 bg-gray-950/45 backdrop-blur-2xl supports-[backdrop-filter]:bg-gray-950/25 md:flex">
            <div class="flex w-full flex-col items-center justify-between py-5">
                <div class="flex flex-col items-center gap-2">
                    @foreach ($navItems as $item)
                        <a
                            wire:navigate
                            href="{{ $item['href'] }}"
                            aria-current="{{ $item['active'] ? 'page' : 'false' }}"
                            class="group relative grid size-12 place-items-center rounded-2xl text-gray-400 transition hover:bg-white/10 hover:text-white {{ $item['active'] ? 'bg-white/15 text-white shadow-lg shadow-black/20' : '' }}"
                        >
                            <i class="{{ $item['active'] ? 'ph-fill' : 'ph-light' }} {{ $item['icon'] }} text-2xl"></i>
                            <span class="pointer-events-none absolute left-15 rounded-full border border-white/10 bg-gray-950/90 px-3 py-1.5 text-xs font-medium text-white opacity-0 shadow-xl shadow-black/30 backdrop-blur-xl transition group-hover:translate-x-1 group-hover:opacity-100">
                                {{ $item['label'] }}
                            </span>
                        </a>
                    @endforeach
                </div>

                <div class="flex flex-col items-center gap-3">
                    @auth
                        <a
                            wire:navigate
                            href="{{ route('posts.create') }}"
                            class="group relative grid size-12 place-items-center rounded-2xl bg-white text-gray-950 shadow-lg shadow-black/20 transition hover:scale-105"
                        >
                            <i class="ph-light ph-note-pencil text-2xl"></i>
                            <span class="pointer-events-none absolute left-15 rounded-full border border-white/10 bg-gray-950/90 px-3 py-1.5 text-xs font-medium text-white opacity-0 shadow-xl shadow-black/30 backdrop-blur-xl transition group-hover:translate-x-1 group-hover:opacity-100">
                                Write
                            </span>
                        </a>

                        <button
                            type="button"
                            class="group relative grid size-12 cursor-pointer place-items-center rounded-2xl text-gray-400 transition hover:bg-white/10 hover:text-white"
                        >
                            <span class="sr-only">View notifications</span>
                            <i class="ph-light ph-bell-simple text-2xl"></i>
                            <span class="pointer-events-none absolute left-15 rounded-full border border-white/10 bg-gray-950/90 px-3 py-1.5 text-xs font-medium text-white opacity-0 shadow-xl shadow-black/30 backdrop-blur-xl transition group-hover:translate-x-1 group-hover:opacity-100">
                                Notifications
                            </span>
                        </button>

                        <livewire:layouts.profile-dropdown />
                    @else
                        <a
                            wire:navigate
                            href="{{ route('login') }}"
                            class="group relative grid size-12 place-items-center rounded-2xl bg-white text-gray-950 shadow-lg shadow-black/20 transition hover:scale-105"
                        >
                            <i class="ph-light ph-sign-in text-2xl"></i>
                            <span class="pointer-events-none absolute left-15 rounded-full border border-white/10 bg-gray-950/90 px-3 py-1.5 text-xs font-medium text-white opacity-0 shadow-xl shadow-black/30 backdrop-blur-xl transition group-hover:translate-x-1 group-hover:opacity-100">
                                Login
                            </span>
                        </a>
                    @endauth
                </div>
            </div>
        </aside>

        {{-- Fixed mobile nav --}}
        <div class="fixed inset-x-3 bottom-3 z-50 rounded-3xl border border-white/10 bg-gray-950/65 px-2 py-2 shadow-2xl shadow-black/40 backdrop-blur-2xl md:hidden">
            <div class="grid grid-cols-5 gap-1">
                @foreach ($navItems as $item)
                    <a
                        wire:navigate
                        href="{{ $item['href'] }}"
                        aria-label="{{ $item['label'] }}"
                        aria-current="{{ $item['active'] ? 'page' : 'false' }}"
                        class="grid h-12 place-items-center rounded-2xl text-gray-400 transition hover:bg-white/10 hover:text-white {{ $item['active'] ? 'bg-white/15 text-white' : '' }}"
                    >
                        <i class="{{ $item['active'] ? 'ph-fill' : 'ph-light' }} {{ $item['icon'] }} text-2xl"></i>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="fixed right-5 bottom-24 z-50 md:hidden">
            @auth
                <a
                    wire:navigate
                    href="{{ route('posts.create') }}"
                    aria-label="Write"
                    class="grid size-12 place-items-center rounded-full bg-white text-gray-950 shadow-2xl shadow-black/40"
                >
                    <i class="ph-light ph-note-pencil text-2xl"></i>
                </a>
            @else
                <a
                    wire:navigate
                    href="{{ route('login') }}"
                    aria-label="Login"
                    class="grid size-12 place-items-center rounded-full bg-white text-gray-950 shadow-2xl shadow-black/40"
                >
                    <i class="ph-light ph-sign-in text-2xl"></i>
                </a>
            @endauth
        </div>
    @else
        <div class="fixed inset-x-0 top-0 z-50 flex items-center justify-between border-b border-white/10 bg-gray-950/55 px-5 py-4 text-gray-200 backdrop-blur-2xl lg:px-32">
            {{-- Left --}}
            <div class="flex items-center space-x-3">
                {{-- Logo --}}
                <a wire:navigate href="{{ route('home') }}" class="text-3xl font-bold">Verse</a>

                {{-- Post status --}}
                <div class="flex items-center space-x-3 text-sm">
                    <div>Draft</div>
                    @if (request()->routeIs('posts.edit'))
                        <div>Saved</div>
                        <div wire:loading.class="text-2xl">Saving...</div>
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

                {{-- More action --}}
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
