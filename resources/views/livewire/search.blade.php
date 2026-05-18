<div 
    x-data="{
        activeTab: 'topics',
        init() {
            this.$watch('activeTab', (value) => {
                if (value === 'posts') {
                    this.$refs.resultsContainer.style.transform = 'translateX(66.66%)';
                    this.$refs.underline.style.transform = 'translateX(-200%)';
                } else if (value === 'people') {
                    this.$refs.resultsContainer.style.transform = 'translateX(33.33%)';
                    this.$refs.underline.style.transform = 'translateX(-100%)';
                } else if (value === 'topics') {
                    this.$refs.resultsContainer.style.transform = 'translateX(0)';
                    this.$refs.underline.style.transform = 'translateX(0)';
                }
            });
        }
    }"
    >
    <div class="mx-16 overflow-hidden">

        {{-- Tab Header --}}
        <div class="mb-8 my-10">
            <h1 class="text-4xl font-semibold mb-6 text-gray-400 flex items-center space-x-2">
                <div>Results for</div>
                <div class="text-gray-200">{{ request()->keywords }}</div>
            </h1>
            <div class="border-b text-gray-400 border-gray-700 text-sm">
                <div class="relative flex items-center w-fit">
                    <a href="#" class="w-20 text-center py-4 hover:text-gray-200" x-on:click.prevent="activeTab = 'posts'" :class="activeTab == 'posts' ? 'text-gray-200' : ''">Posts</a>
                    <a href="#" class="w-20 text-center py-4 hover:text-gray-200" x-on:click.prevent="activeTab = 'people'" :class="activeTab == 'people' ? 'text-gray-200' : ''">People</a>
                    <a href="#" class="w-20 text-center py-4 hover:text-gray-200" x-on:click.prevent="activeTab = 'topics'" :class="activeTab == 'topics' ? 'text-gray-200' : ''">Topics</a>
                    <div 
                        x-ref="underline"
                        class="absolute top-full left-0 h-[0.1px] w-1/3 bg-white translate-x-[200%] transition-transform ease-in-out duration-300">
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab Content --}}
        <div 
            x-ref="resultsContainer"
            class="w-[300%] flex -translate-x-[66.66%] transition-all ease-in-out duration-300">

            {{-- Post result --}}
            <div class="flex w-1/3 flex-col">
                @forelse ($posts as $post)
                <x-post wire:key="{{ $post->id }}" :$post />
                @empty
                <div class="text-gray-400">No posts found.</div>
                @endforelse
            </div>

            {{-- Users result --}}
            <div class="w-1/3">
                @forelse ($users as $user)
                <div class="flex justify-between space-x-10 py-5">
                    <div class="flex space-x-7">
                        {{--Avatar --}}
                        <a wire:navigate href="{{ route('users.show', $user) }}" class="flex space-x-3 hover:opacity-50 transition-all">
                            @if ($user->image)
                            <img src="{{ $user->image->url }}" class="relative size-12 rounded-full outline -outline-offset-1 outline-white/10" />
                            @else
                            <div class="relative z-40 text-xl text-gray-900 bg-white size-12 flex rounded-full font-semibold uppercase">
                                <span class="m-auto">{{ $user->initials() }}</span>
                            </div>
                            @endif
                        </a>
                
                        {{-- Author Profile --}}
                        <div class="flex flex-col justify-baseline space-y-3">
                            <a wire:navigate href="{{ route('users.show', $user) }}" class="hover:underline transition-all">
                                <h2 class="text-xl">{{ $user->name }}</h2>
                            </a>
                
                            <div>
                                <p class="text-sm text-gray-400">{{ $user->bio }}</p>
                            </div>
                        </div>
                    </div>
                
                    <div>
                        <button class="py-2 px-3 text-sm cursor-pointer rounded-full border border-gray-400 text-gray-300">Follow</button>
                    </div>
                </div>
                @empty
                <div class="text-gray-400">No users found.</div>
                @endforelse
            </div>

            {{-- Tags result --}}
            <div class="flex flex-wrap w-1/3 gap-4 items-start h-fit">
                @forelse ($tags as $tag)
                <a href="{{ route('tags.show', $tag) }}" class="py-2 px-4 text-sm rounded-full bg-gray-800">{{ $tag->name }}</a>
                @empty
                <div class="text-gray-400">No tags found.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
