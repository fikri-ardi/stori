<?php

use App\Models\Post;
use Livewire\Component;

new class extends Component
{
    public Post $post;
};
?>

@php
    $bodyText = trim(preg_replace('/\s+/', ' ', strip_tags((string) $post->body)));
    $wordCount = str_word_count($bodyText);
    $readMinutes = max(1, (int) ceil($wordCount / 200));
    $commentsCount = $post->comments()->count();
    $updated = $post->updated_at && $post->updated_at->gt($post->created_at)
        ? $post->updated_at->format('M d, Y')
        : 'No edits yet';
@endphp

<div x-data="{ postInfoModal: false }">
    <button
        type="button"
        @click.stop="postInfoModal = true; modalBackdrop = true; typeof Options !== 'undefined' && (Options = false)"
        class="flex cursor-pointer items-center space-x-3 transition hover:text-white">
        <i class="ph-light ph-file-magnifying-glass text-xl"></i>
        <div>Post info</div>
    </button>

    <template x-teleport="body">
        <div
            x-show="postInfoModal"
            @click.self="postInfoModal = false, modalBackdrop = false"
            @keydown.escape.window="postInfoModal = false, modalBackdrop = false"
            role="dialog"
            aria-modal="true"
            aria-labelledby="post-info-modal-title"
            class="fixed inset-0 z-[60] flex px-4 py-6 sm:px-6">
            <div
                x-show="postInfoModal"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-3 scale-[0.98]"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-3 scale-[0.98]"
                class="m-auto w-full max-w-md overflow-hidden rounded-2xl border border-white/[0.12] bg-black/90 text-gray-200 shadow-[0_24px_80px_rgba(0,0,0,0.5),inset_0_1px_0_rgba(255,255,255,0.1)] backdrop-blur-2xl">
                <div class="border-b border-white/10 px-5 py-5 sm:px-6">
                    <div class="flex items-start justify-between gap-4">
                        <div class="min-w-0">
                            <p class="text-xs font-medium uppercase tracking-[0.22em] text-gray-500">Post info</p>
                            <h2 id="post-info-modal-title" class="mt-2 line-clamp-2 text-xl font-semibold tracking-normal text-white">
                                {{ ucfirst($post->title) }}
                            </h2>
                        </div>

                        <button
                            type="button"
                            @click="postInfoModal = false, modalBackdrop = false"
                            class="grid size-9 shrink-0 cursor-pointer place-items-center rounded-full text-gray-500 transition hover:bg-white/[0.07] hover:text-white"
                            aria-label="Close post info">
                            <i class="ph-light ph-x text-xl"></i>
                        </button>
                    </div>
                </div>

                <div class="px-5 py-5 sm:px-6">
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-sm text-gray-400">
                        <span class="inline-flex items-center gap-1.5">
                            <i class="ph-light ph-clock text-base"></i>
                            {{ $readMinutes }} min read
                        </span>
                        <span class="text-gray-700">/</span>
                        <span>{{ number_format($wordCount) }} words</span>
                        <span class="text-gray-700">/</span>
                        <span>{{ number_format($commentsCount) }} responses</span>
                    </div>

                    <div class="mt-5 divide-y divide-white/10 rounded-2xl border border-white/10 bg-white/[0.03] px-4">
                        <div class="flex items-center justify-between gap-4 py-3 text-sm">
                            <span class="flex items-center gap-2 text-gray-500">
                                <i class="ph-light ph-user-circle text-lg"></i>
                                Author
                            </span>
                            <span class="min-w-0 truncate text-right text-gray-200">{{ ucwords($post->author->name) }}</span>
                        </div>

                        <div class="flex items-center justify-between gap-4 py-3 text-sm">
                            <span class="flex items-center gap-2 text-gray-500">
                                <i class="ph-light ph-calendar-blank text-lg"></i>
                                Published
                            </span>
                            <span class="text-right text-gray-200">{{ $post->created_at->format('M d, Y') }}</span>
                        </div>

                        <div class="flex items-center justify-between gap-4 py-3 text-sm">
                            <span class="flex items-center gap-2 text-gray-500">
                                <i class="ph-light ph-pencil-simple-line text-lg"></i>
                                Updated
                            </span>
                            <span class="text-right text-gray-200">{{ $updated }}</span>
                        </div>
                    </div>

                    @if ($post->tags->isNotEmpty())
                        <div class="mt-5 flex flex-wrap gap-2">
                            @foreach ($post->tags->take(6) as $tag)
                                <a
                                    wire:navigate
                                    href="{{ route('tags.show', $tag) }}"
                                    class="rounded-full bg-white/[0.06] px-3 py-1.5 text-xs font-medium text-gray-300 transition hover:bg-white/10 hover:text-white">
                                    {{ ucwords($tag->name) }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </template>
</div>
