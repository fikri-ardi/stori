<x-layouts.app title="Explore Topics">
    <div>
        {{-- Explore Topics --}}
        <x-tag-header :$tags />

        {{-- header --}}
        <div class="flex flex-col items-center justify-center py-14 space-y-5">
            <h2 class="text-4xl font-semibold">Explore Topics</h2>
            <div>Topic . 183K followers . 70K posts</div>
            <button class="py-2 px-3 text-sm cursor-pointer rounded-full border text-gray-800 font-semibold bg-gray-300">Follow</button>
        </div>

        {{-- Posts --}}
        <div class="border-t border-gray-800">
            {{-- Header --}}
            <div class="text-2xl font-semibold py-10">Recommended posts</div>
        </div>
    </div>
</x-layouts.app>