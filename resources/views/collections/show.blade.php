<x-layouts.app title="Posts" header="From the blog">
    <div class="px-5">
        <div class="mb-8 my-10">
            <h1 class="text-4xl font-semibold mb-8 text-gray-200 flex items-center space-x-2">
                <div>{{ $collection->name }}</div>
            </h1>
            <div class="flex items-center pb-4 border-b text-gray-400 border-gray-700 text-sm space-x-10">
                In <a href="{{ route('users.show', $collection->owner) }}" class="text-white mx-2 hover:underline transition-all">
                    {{ $collection->owner->name }}
                </a> Collections
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