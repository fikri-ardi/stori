<x-layouts.app title="Posts" header="From the blog">
    <div class="flex flex-wrap justify-between space-y-10">
        @foreach ($posts as $post)
            <article class="md:max-w-[368px] flex flex-col justify-between h-[29rem]">
                {{-- Banner --}}
                <div class="w-full h-56">
                    <a href="{{ route('posts.show', $post->slug) }}">
                        <img src="{{ $post->images->first()->url ?? '' }}" alt="Gambar Post" class="w-full h-full object-cover rounded-2xl mb-4">
                    </a>
                </div>

                {{-- Content --}}
                <div>
                    <div class="flex items-center gap-4 text-xs text-gray-500 mb-2">
                        <div>{{ $post->created_at->format('M d, o') }}</div>
                        <a class="py-2 px-3 rounded-full bg-gray-800 text-gray-300 font-semibold">{{ $post->tags->first()->name }}</a>
                    </div>
                    <a href="{{ route('posts.show', $post->slug) }}">
                        <h2 class="text-lg font-semibold mb-4">{{ $post->title }}</h2>
                        <p class="text-gray-400 text-sm leading-relaxed text-justify">{{ $post->excerpt }}</p>
                    </a>
                </div>
            
                {{-- Author --}}
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full overflow-hidden">
                        <img src="{{ $post->author->image->url }}" alt="Foto penulis">
                    </div>
                    <div class="text-sm text-gray-300">
                        <div class="font-semibold text-white">{{ $post->author->name }}</div>
                        <div>{{ ucwords($post->author->role->name) }}</div>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</x-layouts.app>