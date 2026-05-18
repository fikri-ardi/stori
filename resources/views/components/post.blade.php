@props(['post'])

<article {{ $attributes->class('group border-b border-white/10 py-7 last:border-b-0') }}>
    <div class="flex items-start justify-between gap-4 sm:gap-6">
        {{-- Content --}}
        <div class="min-w-0 flex-1">
            {{-- Author --}}
            <div class="mb-3 flex min-w-0 items-center gap-2 text-sm text-gray-400">
                <a wire:navigate href="{{ route('users.show', $post->author) }}" class="size-7 shrink-0 overflow-hidden rounded-full transition hover:opacity-70 sm:size-8">
                    @if ($post->author->image != null)
                        <img src="{{ $post->author->image->url }}" alt="" class="h-full w-full object-cover" />
                    @else
                        <div class="flex size-full bg-white text-xs font-semibold uppercase text-gray-900 sm:text-sm">
                            <span class="m-auto">{{ $post->author->initials() }}</span>
                        </div>
                    @endif
                </a>

                <a wire:navigate href="{{ route('users.show', $post->author) }}" class="min-w-0 truncate font-medium text-gray-200 transition hover:text-white hover:underline">
                    {{ ucwords($post->author->name) }}
                </a>

                <span class="size-1 shrink-0 rounded-full bg-gray-600"></span>
                <span class="shrink-0 text-xs text-gray-500 sm:text-sm">{{ $post->created_at->format('M d') }}</span>
            </div>

            {{-- Body --}}
            <a wire:navigate href="{{ route('posts.show', $post->slug) }}" class="block">
                <h2 class="line-clamp-2 text-base font-semibold leading-snug text-gray-100 transition group-hover:text-white sm:text-2xl">
                    {{ str($post->title)->lower()->ucfirst() }}
                </h2>
                <p class="mt-2 line-clamp-2 text-sm leading-6 text-gray-400 sm:mt-3 sm:line-clamp-3 sm:text-base sm:leading-7">
                    {{ $post->excerpt }}
                </p>
            </a>

            {{-- Post Info --}}
            <div class="mt-4 flex items-center justify-between gap-4 sm:mt-5">
                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-xs text-gray-400 sm:gap-x-5">
                    {{-- Views --}}
                    <div class="flex items-center gap-1.5">
                        <i class="ph-light ph-eye text-xl"></i>
                        <span>{{ number_format($post->visitors()->count()) }}</span>
                    </div>

                    {{-- Claps --}}
                    <div class="flex items-center gap-1.5">
                        <i class="ph-light ph-hands-clapping text-xl"></i>
                        <span>{{ number_format($post->claps->sum('count')) }}</span>
                    </div>

                    {{-- Comments --}}
                    <div class="flex items-center gap-1.5">
                        <i class="ph-light ph-chat-teardrop-dots text-xl"></i>
                        <span>{{ number_format($post->comments->count()) }}</span>
                    </div>
                </div>

                {{-- Bookmark --}}
                <button type="button" class="grid size-9 shrink-0 cursor-pointer place-items-center rounded-full text-gray-400 transition hover:bg-white/10 hover:text-white sm:size-10">
                    <span class="sr-only">Save post</span>
                    <i class="ph-light ph-bookmark-simple text-2xl"></i>
                </button>
            </div>
        </div>

        {{-- Banner --}}
        <a wire:navigate href="{{ route('posts.show', $post->slug) }}" class="block h-24 w-24 shrink-0 overflow-hidden rounded-xl bg-white/5 sm:h-36 sm:w-52 md:w-60">
            @if ($post->images->first())
                <img
                    src="{{ $post->images->first()->url }}"
                    alt="Gambar Post"
                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                >
            @else
                <div class="grid h-full w-full place-items-center text-gray-600">
                    <i class="ph-light ph-image text-4xl"></i>
                </div>
            @endif
        </a>
    </div>
</article>
