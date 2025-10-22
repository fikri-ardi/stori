<x-layouts.app title="Posts" header="Posts">
    <div class="flex justify-center">
        <article class="w-7/12 flex flex-col gap-7">
            {{-- Banner --}}
            <div class="w-full h-80">
                <img src="{{ $post->images->first()->url }}" alt="Gambar Post" class="w-full h-full rounded object-cover object-center">
            </div>
            
            {{-- Title --}}
            <div class="mb-3 mt-2">
                <h1 class="text-4xl font-semibold">{{ ucfirst($post->title) }}</h1>
            </div>

            {{-- Author --}}
            <div class="flex gap-5 items-center">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full overflow-hidden">
                        <img src="{{ $post->author->image->url }}" alt="Foto penulis">
                    </div>
                    <div class="text-sm text-gray-300">
                        <div class="font-semibold text-white">{{ $post->author->name }}</div>
                        <div>{{ ucwords($post->author->role->name) }}</div>
                    </div>
                </div>
                
                {{-- Info --}}
                <div class="flex items-center gap-4 text-sm text-gray-500 mb-2">
                    <button class="py-2 px-3 cursor-pointer rounded-full bg-gray-800 text-gray-300">Follow</button>
                    <div>{{ $post->created_at->format('M d, o') }}</div>
                </div>
            </div>

            {{-- Content --}}
            <p class="text-lg leading-9 text-gray-200 mb-5">{{ $post->body }}</p>

            {{-- Tag --}}
            <div class="flex items-center space-x-2">
            @foreach ($post->tags as $tag)
            <span>
                <a href="#" class="py-3 px-4 text-sm rounded-full bg-gray-800">{{ $tag->name }}</a>
            </span>
            @endforeach
            </div>

            <div class="mt-10">
                <a href="{{ url()->previous() }}" class="hover:underline"> &laquo; Back</a>
            </div>
        </article>
    </div>
</x-layouts.app>