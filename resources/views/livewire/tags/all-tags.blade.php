<div>
    {{-- Explore Topics --}}
    <x-tag-header :$tags />

    {{-- header --}}
    <div class="flex flex-col items-center justify-center py-14 space-y-5">
        <h2 class="text-4xl font-semibold">Explore topics</h2>

        {{-- Search Box --}}
        <form wire:submit="search" method="get"
            class="flex items-center space-x-4 rounded-full border border-white/10 bg-white/[0.045] px-5 py-3 text-sm text-gray-200 backdrop-blur-xl transition focus-within:border-white/20 focus-within:bg-white/[0.065] w-1/2">
            <i class="ph-light ph-magnifying-glass text-2xl text-gray-500"></i>
            <input wire:model.live="keywords" type="text" name="keywords" placeholder="What are you interest in?" class="w-full bg-transparent outline-none placeholder:text-gray-600">
        </form>

        <span class="text-sm flex items-center space-x-2">
            <span>Recomended:</span>
            <span class="flex items-center space-x-2">
                <a class="hover:underline" href="#">Programming</a>
                <a class="hover:underline" href="#">Self-Development</a>
                <a class="hover:underline" href="#">Movies</a></span>
        </span>
    </div>

    {{-- Topics --}}
    <div class="border-t border-white/10 py-16 flex items-center justify-between flex-wrap">
        {{-- Header --}}
        @foreach ($tags as $tag)
        <a wire:navigate href="{{ route('tags.show', $tag) }}" class="w-1/3 py-4 px-10 text-gray-300 transition hover:text-white hover:underline">
            {{ $tag->name }}
        </a>
        @endforeach
    </div>
</div>
