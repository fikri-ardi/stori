@props(['post'])

<article {{ $attributes->class('group border-b border-white/10 py-7 last:border-b-0') }}>
    <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
        {{-- Content --}}
        <div class="min-w-0 flex-1">
            {{-- Author --}}
            <div class="mb-4">
                <x-author :author="$post->author" />
            </div>

            {{-- Body --}}
            <a wire:navigate href="{{ route('posts.show', $post->slug) }}" class="block">
                <h2 class="text-2xl font-semibold leading-snug text-gray-100 transition group-hover:text-white">
                    {{ str($post->title)->lower()->ucfirst() }}
                </h2>
                <p class="mt-3 line-clamp-3 text-sm leading-7 text-gray-400 sm:text-base">
                    {{ $post->excerpt }}
                </p>
            </a>

            {{-- Post Info --}}
            <div class="mt-5 flex items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-xs text-gray-400">
                    {{-- Date --}}
                    <div class="flex items-center gap-1.5">
                        <i class="ph-light ph-calendar-dots text-xl"></i>
                        <span>{{ $post->created_at->format('M d') }}</span>
                    </div>

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
                </div>

                {{-- Bookmark --}}
                <button type="button" class="grid size-10 shrink-0 cursor-pointer place-items-center rounded-full text-gray-400 transition hover:bg-white/10 hover:text-white">
                    <span class="sr-only">Save post</span>
                    <i class="ph-light ph-bookmark-simple text-2xl"></i>
                </button>
            </div>
        </div>

        {{-- Banner --}}
        <a wire:navigate href="{{ route('posts.show', $post->slug) }}" class="block h-36 w-full shrink-0 overflow-hidden rounded-xl bg-white/5 sm:w-52 md:w-60">
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
