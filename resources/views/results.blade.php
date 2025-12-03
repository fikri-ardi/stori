<x-layouts.app title="Posts" header="From the blog">
    <div class="px-16">
        <div class="mb-8 my-10">
            <h1 class="text-4xl font-semibold mb-6 text-gray-400 flex items-center space-x-2">
                <div>Results for</div>
                <div class="text-gray-200">{{ request()->keywords }}</div>
            </h1>
            <div class="flex items-center border-b text-gray-400 border-gray-700 text-sm space-x-10">
                <a href="#" class="py-4 hover:text-gray-200">Posts</a>
                <a href="#" class="py-4 hover:text-gray-200">People</a>
                <a href="#" class="py-4 text-gray-200 border-b border-gray-200">Topics</a>
            </div>
        </div>
        <div class="flex flex-wrap gap-4">
            @forelse ($tags as $tag)
            <a href="{{ route('tags.show', $tag) }}" class="py-3 px-4 text-sm rounded-full bg-gray-800">{{ $tag->name }}</a>
            @empty
            <div class="text-gray-400">No tags found.</div>
            @endforelse
        </div>
    </div>
</x-layouts.app>