<x-layouts.app title="Posts" header="From the blog">
    <div class="px-5">
        <div class="pb-2 my-10 border-b border-gray-800">
            <h1 class="text-4xl font-semibold mb-10 text-gray-200 flex items-center space-x-2">
                <div>{{ $collection->name }}</div>
            </h1>
            <div class="flex items-center pb-4 text-gray-400 text-sm space-x-2">
                <x-author :author="$collection->owner"/>
                <span>Collections</span>
            </div>
        </div>
        <div class="flex flex-wrap gap-4">
            @forelse ($collection->posts as $post)
            <x-post :$post />
            @empty
            <div class="text-gray-400">No post found.</div>
            @endforelse
        </div>
    </div>
</x-layouts.app>