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
        <div 
            x-ref="resultsContainer"
            class="w-[300%] flex -translate-x-[66.66%] transition-all ease-in-out duration-300">
            <div class="flex flex-wrap w-1/3 gap-4">
                @forelse ($tags as $tag)
                <a href="{{ route('tags.show', $tag) }}" class="py-3 px-4 text-sm rounded-full bg-gray-800">{{ $tag->name }}</a>
                @empty
                <div class="text-gray-400">No tags found.</div>
                @endforelse
            </div>
            <div class="flex flex-wrap w-1/3 gap-4">
                @forelse ($tags as $tag)
                <a href="{{ route('tags.show', $tag) }}" class="py-3 px-4 text-sm rounded-full bg-gray-800">{{ $tag->name }}</a>
                @empty
                <div class="text-gray-400">No tags found.</div>
                @endforelse
            </div>
            <div class="flex flex-wrap w-1/3 gap-4">
                @forelse ($tags as $tag)
                <a href="{{ route('tags.show', $tag) }}" class="py-3 px-4 text-sm rounded-full bg-gray-800">{{ $tag->name }}</a>
                @empty
                <div class="text-gray-400">No tags found.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
