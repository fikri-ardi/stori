<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900 scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:image" content="{{ asset('images/og image.png') }}">
    <meta property="og:description" content="Social media platform for sharing posts and connecting with others.">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <title>{{ $title ?? config('app.name') }}</title>
</head>

<body
    x-data="{ 
        loginModal: false, 
        modalBackdrop: false,
        sidebarOpen: JSON.parse(localStorage.getItem('verse-sidebar-open') ?? 'false'),
        syncSidebarOffset() {
            document.documentElement.style.setProperty('--sidebar-offset', this.sidebarOpen ? '15rem' : '6rem')
        },
        toggleSidebar() {
            this.sidebarOpen = ! this.sidebarOpen
            localStorage.setItem('verse-sidebar-open', JSON.stringify(this.sidebarOpen))
            this.syncSidebarOffset()
        },
    }"
    x-init="syncSidebarOffset()"
    class="relative min-h-full font-inter">

    <livewire:navbar />
    <livewire:ui.toast />
    <x-partials.login-modal />
    <livewire:modal-backdrop />

    <main @class([
        'text-gray-200 px-5',
        'pt-20 pb-24 md:pl-[var(--sidebar-offset,6rem)] md:pb-0 md:transition-[padding-left] md:duration-300 md:ease-out' => !request()->routeIs('posts.create') && !request()->routeIs('posts.edit'),
        'pt-20' => request()->routeIs('posts.create') || request()->routeIs('posts.edit'),
    ])>
        <div @class([
            'mx-auto px-4 py-6 sm:px-6 lg:px-8',
            'max-w-[92rem]' => request()->routeIs('home'),
            'max-w-7xl' => !request()->routeIs('home'),
        ])>
            {{ $slot }}
        </div>
    </main>

    @if (!request()->routeIs('posts.create') && !request()->routeIs('posts.edit'))
    <x-footer />
    @endif

    @livewireScripts
</body>

</html>
