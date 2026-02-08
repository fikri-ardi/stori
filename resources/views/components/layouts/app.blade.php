<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900 scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? config('app.name') }}</title>
</head>

<body
x-data="{ loginModal: false }"
x-on:show-login-modal.window="loginModal = true"
class="relative min-h-full font-inter">
    <livewire:navbar />
    <x-partials.login-modal />

    <main class="text-gray-200 px-5">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    <x-footer />
</body>

</html>