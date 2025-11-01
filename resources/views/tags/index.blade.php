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
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256" class="fill-gray-200 w-6">
                    <path
                        d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
                    </path>
                </svg>
                <input type="text" name="search" placeholder="What are you interest in?" class="w-full outline-none">
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