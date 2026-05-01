@props(['post'])

<article class="md:max-w-[333px] flex flex-col justify-between">
    {{-- Banner --}}
    <div class="w-full h-56 mb-7">
        <a wire:navigate href="{{ route('posts.show', $post->slug) }}">
            <img src="{{ $post->images->first()->url ?? '' }}" alt="Gambar Post" class="w-full h-full object-cover rounded-2xl">
        </a>
    </div>

    {{-- Content --}}
    <div>
        {{-- Post Info --}}
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-4 text-xs text-gray-400">
                {{--Date --}}
                <div class="flex items-center space-x-1">
                    <i class="ph-light ph-calendar-dots text-2xl"></i>
                    <span>
                        {{ $post->created_at->format('M d') }}
                    </span>
                </div>
                {{-- Views --}}
                <div class="flex items-center space-x-1">
                    <i class="ph-light ph-eye text-2xl"></i>
                    <span>{{ number_format($post->visitors()->count()) }}</span>
                </div>

                {{-- Claps --}}
                <div class="flex items-center space-x-1">
                    <i class="ph-light ph-hands-clapping text-2xl"></i>
                    <span>{{ number_format($post->claps->sum('count')) }}</span>
                </div>
            </div>

            {{-- Bookmark --}}
            <button type="button" class="cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#99a1af" viewBox="0 0 256 256">
                    <path
                        d="M184,32H72A16,16,0,0,0,56,48V224a8,8,0,0,0,12.24,6.78L128,193.43l59.77,37.35A8,8,0,0,0,200,224V48A16,16,0,0,0,184,32Zm0,177.57-51.77-32.35a8,8,0,0,0-8.48,0L72,209.57V48H184Z">
                    </path>
                </svg>
            </button>
        </div>

        {{-- Body --}}
        <a wire:navigate href="{{ route('posts.show', $post->slug) }}">
            <h2 class="text-xl font-semibold">{{ str($post->title)->lower()->ucfirst() }}</h2>
            <p class="text-gray-400 leading-relaxed mt-5 mb-7">{{ $post->excerpt }}</p>
        </a>
    </div>

    {{-- Author --}}
    <x-author :author="$post->author" />
</article>