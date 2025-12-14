<div class="flex flex-col items-center">
    <article class="w-7/12 flex flex-col gap-7">
        {{-- Title --}}
        <div class="mb-3 mt-2">
            <h1 class="text-4xl font-semibold">{{ ucfirst($post->title) }}</h1>
            <p class="text-xl text-gray-400 mt-4">{{ ucfirst($post->excerpt) }}</p>
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

        {{-- Action Button --}}
        <div class="flex items-center justify-between py-4 border-t border-b border-gray-800 text-sm text-gray-500">
            <div class="flex items-center space-x-7">
                {{-- Claps --}}
                <button x-data="{userClaps: $wire.entangle('userClaps')}" 
                x-on:post-clapped.window="
                $refs.popup.classList.remove('animate-fadein');
                void $refs.popup.offsetWidth;
                $refs.popup.classList.add('animate-fadein');
                "
                class="relative flex items-center space-x-2 cursor-pointer">

                    {{-- User's Claps Popups --}}
                    <div wire:ignore x-ref="popup"
                        class="absolute flex bottom-full bg-white size-8 rounded-full font-semibold text-black opacity-0">
                        <span x-text="'+'+userClaps" class="m-auto"></span>
                    </div>

                    {{-- Clap Button --}}
                    <i wire:click="clap" class="{{ $post->claps()->where('user_id', auth()->id())->exists() ? 'ph-fill' : 'ph-light' }} ph-hands-clapping text-2xl hover:text-white transition-all active:scale-110"
                    ></i>
                    <span>{{ number_format($post->claps->sum('count')) }}</span>
                </button>
                {{-- Comments --}}
                <a href="#comments" class="flex items-center space-x-2 cursor-pointer">
                    <i class="ph-light ph-chat-teardrop-dots text-2xl"></i>
                    <span>{{ number_format($post->comments->count()) }}</span>
                </a>
            </div>

            <div class="flex items-center space-x-7">
                {{-- Bookmark --}}
                <button type="button" class="cursor-pointer">
                    <i class="ph-light ph-bookmark-simple text-2xl"></i>
                </button>

                {{-- Share --}}
                <button type="button" class="cursor-pointer">
                    <i class="ph-light ph-export text-2xl"></i>
                </button>

                {{-- More Options --}}
                <button type="button" class="cursor-pointer">
                    <i class="ph-light ph-dots-three text-2xl"></i>
                </button>
            </div>
        </div>

        {{-- Banner --}}
        <div class="w-full h-80">
            <img src="{{ $post->images->first()->url }}" alt="Gambar Post" class="w-full h-full rounded object-cover object-center">
        </div>

        {{-- Content --}}
        <p class="text-lg leading-10 text-gray-300 mb-5">{{ ucfirst($post->body) }}</p>

        {{-- Tag --}}
        <div class="flex items-center space-x-2">
            @foreach ($post->tags as $tag)
            <span>
                <a wire:navigate  href="{{ route('tags.show', $tag->slug) }}" class="py-3 px-4 text-sm rounded-full bg-gray-800">{{ $tag->name }}</a>
            </span>
            @endforeach
        </div>

        {{-- Action Button --}}
        <div class="flex items-center justify-between py-4 text-sm text-gray-500 my-5">
            <div class="flex items-center space-x-7">
                {{-- Claps --}}
                <button class="flex items-center space-x-2 cursor-pointer">
                    <i class="ph-light ph-hands-clapping text-2xl"></i>
                    <span>{{ number_format($post->claps->sum('count')) }}</span>
                </button>
                {{-- Comments --}}
                <a href="#comments" class="flex items-center space-x-2 cursor-pointer">
                    <i class="ph-light ph-chat-teardrop-dots text-2xl"></i>
                    <span>{{ number_format($post->comments->count()) }}</span>
                </a>
            </div>

            <div class="flex items-center space-x-7">
                {{-- Bookmark --}}
                <button type="button" class="cursor-pointer">
                    <i class="ph-light ph-bookmark-simple text-2xl"></i>
                </button>

                {{-- Share --}}
                <button type="button" class="cursor-pointer">
                    <i class="ph-light ph-export text-2xl"></i>
                </button>

                {{-- More Options --}}
                <button type="button" class="cursor-pointer">
                    <i class="ph-light ph-dots-three text-2xl"></i>
                </button>
            </div>
        </div>

        {{-- Author Info --}}
        <div class="flex justify-between">
            <div class="flex space-x-5">
                {{--Avatar --}}
                <a wire:navigate href="{{ route('users.show', $post->author) }}" class="flex space-x-3 hover:opacity-50 transition-all">
                    <div class="w-12 h-12 rounded-full overflow-hidden">
                        <img src="{{ $post->author->image->url }}" alt="Foto penulis">
                    </div>
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
    <div class="flex flex-col items-start space-y-20 py-20 w-7/12">
        <div class="text-2xl font-semibold">
            Responses ({{ $post->comments->count() }})
        </div>

        <div class="flex flex-col space-y-7 w-full" id="comments">
            @foreach ($post->comments as $comment)
            <div wire:key="{{ $comment->id }}" class="flex flex-col space-y-4 border-b border-gray-800 pb-6 w-full">
                {{-- Comment Author --}}
                <div class="flex items-center space-x-3">
                    <a wire:navigate href="{{ route('users.show', $comment->author) }}"
                        class="w-10 h-10 text-sm rounded-full overflow-hidden flex items-center justify-center">
                        <img src="{{ $comment->author->image->url }}" alt="Author Photo"
                            class="w-full h-full object-cover hover:opacity-50 transition-all">
                    </a>
                    <div class="text-sm text-gray-300 flex flex-col">
                        <a wire:navigate href="{{ route('users.show', $comment->author) }}" class="text-white hover:underline transition-all">{{
                            $comment->author->name }}</a>
                        <div>{{ $comment->created_at->format('M d') }}</div>
                    </div>
                </div>

                {{-- Comment Body --}}
                <div>
                    <p class="text-sm leading-8">{{ $comment->body }}</p>
                </div>

                {{-- Action button --}}
                <div class="flex items-center text-sm space-x-4 text-gray-400">
                    {{-- Claps --}}
                    <div class="flex items-center space-x-2">
                        <i class="ph-light ph-hands-clapping text-xl"></i>
                        <span>{{ number_format($comment->claps->sum('count')) }}</span>
                    </div>

                    {{-- Reply --}}
                    <a href="#" class="underline text-gray-200">Reply</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
