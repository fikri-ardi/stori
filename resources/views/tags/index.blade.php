<x-layouts.app title="Explore Topics">
    <div>
        {{-- Explore Topics --}}
        <x-tag-header :$tags />

        {{-- header --}}
        <div class="flex flex-col items-center justify-center py-14 space-y-5">
            <h2 class="text-4xl font-semibold">Explore topics</h2>

            {{-- Search Box --}}
            <form action="{{ route('tags.search') }}" method="get"
            class="flex items-center space-x-4 bg-gray-800 px-5 py-3 rounded-full w-1/2 text-sm"
            >
                <i class="ph-light ph-magnifying-glass text-2xl"></i>
                <input type="text" name="keywords" placeholder="What are you interest in?" class="w-full outline-none">
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
        <div class="border-t border-gray-800 py-16 flex items-center justify-between flex-wrap">
            {{-- Header --}}
            @foreach ($tags as $tag)
            <a href="{{ route('tags.show', $tag) }}" class="w-1/3 py-4 px-10 hover:underline">
                {{ $tag->name }}
            </a>
            @endforeach
        </div>
    </div>
</x-layouts.app>