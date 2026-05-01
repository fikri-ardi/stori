<div class="flex flex-col items-center">
    <article class="w-7/12 flex flex-col gap-7">
        {{-- Title --}}
        <div class="mb-3 mt-2">
            <h1 class="text-4xl font-semibold">{{ ucfirst($post->title) }}</h1>
            <p class="text-xl text-gray-400 mt-4">{!! ucfirst($post->excerpt) !!}</p>
        </div>

        {{-- Author --}}
        <div class="flex space-x-5 items-center -mt-4 mb-2">
            <x-author :author="$post->author" />

            {{-- Follow --}}
            <div class="flex items-center space-x-4 text-sm text-gray-300">
                <button class="py-2 px-3 cursor-pointer rounded-full border border-gray-400 text-gray-300">Follow</button>
                <div>{{ $post->created_at->format('M d, o') }}</div>
            </div>
        </div>

        {{-- Post stats --}}
        <div class="border-y border-gray-800">
            <x-partials.post-stats :$post />
        </div>

        {{-- Banner --}}
        @if ($post->images->isNotEmpty())
        <div class="w-full h-80">
            @if (str($post->images->first()->url)->contains('https'))
            <img src="{{ $post->images->first()->url }}" alt="Gambar Post" class="w-full h-full rounded object-cover object-center">
            @else
            <img src="{{ config('app.url').$post->images->first()->url }}" alt="Gambar Post" class="w-full h-full rounded object-cover object-center">
            @endif
        </div>
        @endif

        {{-- Content --}}
        <div class="tiptap-editor text-lg leading-10 text-gray-300 mb-5">
            {!! Str::markdown($post->body) !!}
        </div>

        {{-- Tag --}}
        <div class="flex items-center space-x-2 flex-wrap">
            @foreach ($post->tags as $tag)
            <span class="my-3.5">
                <a wire:navigate  href="{{ route('tags.show', $tag->slug) }}" class="py-3 px-4 text-sm rounded-full bg-gray-800">{{ $tag->name }}</a>
            </span>
            @endforeach
        </div>

        {{-- Post stats --}}
        <div class="my-5">
            <x-partials.post-stats :$post />
        </div>

        {{-- Author Info --}}
        <div class="flex justify-between">
            <div class="flex space-x-5">
                {{--Avatar --}}
                <a wire:navigate href="{{ route('users.show', $post->author) }}" class="flex space-x-3 hover:opacity-50 transition-all">
                    @if ($post->author->image)
                    <img src="{{ $post->author->image->url }}" class="relative size-12 rounded-full outline -outline-offset-1 outline-white/10" />
                    @else
                    <div class="relative z-40 text-xl text-gray-900 bg-white size-12 flex rounded-full font-semibold uppercase">
                        <span class="m-auto">{{ $post->author->initials() }}</span>
                    </div>
                    @endif
                </a>

                {{-- Author Profile --}}
                <div class="flex flex-col justify-baseline space-y-3">
                    <a wire:navigate href="{{ route('users.show', $post->author) }}" class="hover:underline transition-all">
                        <h2 class="text-xl">Written by {{ $post->author->name }}</h2>
                    </a>

                    {{-- Followers --}}
                    <div class="flex items-center text-sm space-x-1 text-gray-400">
                        <div>{{ $post->author->followers->count() }} Followers</div>

                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="#99a1af" viewBox="0 0 256 256">
                            <path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128Z"></path>
                        </svg>

                        <div>{{ $post->author->followings->count() }} Following</div>
                    </div>
                    <div>
                        <p class="text-sm">{{ $post->author->bio }}</p>
                    </div>
                </div>
            </div>

            <div>
                <button class="py-2 px-3 text-sm cursor-pointer rounded-full border border-gray-400 text-gray-300">Follow</button>
            </div>
        </div>
    </article>

    {{-- Comment Section --}}
    <div class="flex flex-col items-start space-y-20 py-20 w-7/12" id="comments">
        <div 
            x-data 
            x-on:comment-created.window="$wire.$refresh()" 
            x-on:comment-deleted.window="$wire.$refresh()" 
            x-on:comment-updated.window="$wire.$refresh()" 
            class="text-2xl font-semibold mb-8">
            Responses ({{ $post->comments->count() }})
        </div>

        {{-- Comment Form --}}
        @auth
        <livewire:comments.create-comment :$post />
        @endauth
        
        {{-- Post Comments --}}
        <livewire:comments.all-comments :$post :comments="$post->comments->sortDesc()" />
    </div>
</div>
