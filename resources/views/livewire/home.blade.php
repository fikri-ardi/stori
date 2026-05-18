<div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-[minmax(0,1fr)_21rem]">
    {{-- Main post list --}}
    <section class="min-w-0">
        <div class="border-b border-white/10 pb-6">
            <p class="text-sm font-medium text-gray-400">Today on Verse</p>
        </div>

        <div class="flex flex-col">
            @forelse ($posts as $post)
                <x-post wire:key="home-post-{{ $post->id }}" :$post />
            @empty
                <div class="py-16 text-center text-gray-400">No stories yet.</div>
            @endforelse
        </div>
    </section>

    {{-- Right sidebar --}}
    <aside class="lg:sticky lg:top-24 lg:max-h-[calc(100vh-7rem)] lg:overflow-y-auto lg:pr-1 no-scrollbar">
        <div class="space-y-10 pb-8">
            {{-- Popular posts --}}
            <section class="border-b border-white/10 pb-8">
                <h2 class="text-base font-semibold text-white">Popular posts</h2>

                <div class="mt-5 space-y-6">
                    @forelse ($popularPosts as $post)
                        <a wire:navigate href="{{ route('posts.show', $post->slug) }}" class="group flex gap-4">
                            <div class="min-w-0">
                                <div class="mb-2 flex min-w-0 items-center gap-2 text-xs text-gray-400">
                                    @if ($post->author->image)
                                        <img src="{{ $post->author->image->url }}" alt="" class="size-5 shrink-0 rounded-full object-cover">
                                    @else
                                        <span class="grid size-5 shrink-0 place-items-center rounded-full bg-white text-[10px] font-semibold uppercase text-gray-900">
                                            {{ $post->author->initials() }}
                                        </span>
                                    @endif
                                    <span class="truncate text-white">{{ ucwords($post->author->name) }}</span>
                                </div>

                                <h3 class="line-clamp-2 font-semibold leading-6 text-gray-200 transition group-hover:text-white">
                                    {{ str($post->title)->lower()->ucfirst() }}
                                </h3>

                                <div class="mt-2 flex items-center gap-3 text-xs text-gray-500">
                                    <span class="shrink-0 text-xs text-gray-500">{{ $post->created_at->format('M d') }}</span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500">Popular posts will show up here.</p>
                    @endforelse
                </div>
            </section>

            {{-- Recommended topics --}}
            <section class="border-b border-white/10 pb-8">
                <h2 class="text-base font-semibold text-white">Recommended topics</h2>

                <div class="mt-5 flex flex-wrap gap-2">
                    @forelse ($topics as $topic)
                        <a wire:navigate href="{{ route('tags.show', $topic) }}" class="rounded-full bg-white/10 px-4 py-2 text-sm text-gray-300 transition hover:bg-white hover:text-gray-950">
                            {{ ucwords($topic->name) }}
                        </a>
                    @empty
                        <p class="text-sm text-gray-500">No topics yet.</p>
                    @endforelse
                </div>
            </section>

            {{-- Reading list --}}
            <section>
                <div class="flex items-center justify-between gap-4">
                    <h2 class="text-base font-semibold text-white">Your reading list</h2>
                    @if ($readingList)
                        <a wire:navigate href="{{ route('collections.show', $readingList) }}" class="text-xs font-medium text-gray-400 hover:text-white">See all</a>
                    @endif
                </div>

                <div class="mt-5 space-y-4">
                    @auth
                        @if ($readingList && $readingList->posts->count() > 0)
                            @foreach ($readingList->posts as $post)
                                <a wire:navigate href="{{ route('posts.show', $post->slug) }}" class="group block">
                                    <div class="flex items-start gap-3">
                                        <div class="mt-1 grid size-8 shrink-0 place-items-center rounded-full bg-white/10 text-gray-300">
                                            <i class="ph-light ph-bookmark-simple text-lg"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <h3 class="line-clamp-2 text-sm font-semibold leading-6 text-gray-200 group-hover:text-white">
                                                {{ str($post->title)->lower()->ucfirst() }}
                                            </h3>
                                            <p class="mt-1 truncate text-xs text-gray-500">
                                                {{ ucwords($post->author->name) }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="rounded-2xl border border-dashed border-white/15 p-5 text-sm leading-6 text-gray-400">
                                Save stories with the bookmark button, then they will land here.
                            </div>
                        @endif
                    @else
                        <div class="rounded-2xl border border-dashed border-white/15 p-5 text-sm leading-6 text-gray-400">
                            <p>Login to keep stories for later.</p>
                            <a wire:navigate href="{{ route('login') }}" class="mt-4 inline-flex rounded-full bg-white px-4 py-2 text-sm font-semibold text-gray-950">
                                Login
                            </a>
                        </div>
                    @endauth
                </div>
            </section>
        </div>
    </aside>
</div>
