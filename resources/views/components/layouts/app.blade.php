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
    <title>{{ $title ?? config('app.name') }}</title>
</head>

<body
x-data="{ loginModal: false, modalBackdrop: false}"
@open-login-modal.window="loginModal = true, modalBackdrop = true"
class="relative min-h-full font-inter">

    <livewire:navbar />
    <livewire:ui.toast />
    <x-partials.login-modal />
    <livewire:modal-backdrop />

    <main class="text-gray-200 px-5">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    <x-footer />
</body>

</html>