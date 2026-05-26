<x-layouts.app title="{{ $user->name }} | Social Media" header="About">
    <div class="min-h-screen flex justify-center -mt-5" x-data="{ tab: 'posts' }">
        <div class="w-full max-w-5xl">
            <div class="flex items-center px-24">
                {{-- User Photo Profile --}}
                <div class="p-14 w-4/12">
                    @if ($user->image)
                    <img src="{{ $user->image->url }}" alt="Avatar" class="size-40 rounded-full object-cover" />
                    @else
                    <div class="relative text-gray-900 bg-white size-40 flex rounded-full font-semibold uppercase text-5xl">
                        <span class="m-auto">{{ $user->initials() }}</span>
                    </div>
                    @endif
                </div>

                {{-- User Info --}}
                <div class="w-7/12">
                    <!-- Header like Medium -->
                    <div class="flex items-center mb-4">
                        <h2 class="text-2xl mr-10 font-semibold">{{ $user->username }}</h2>
                        <div class="flex items-center space-x-4">
                            <button class="py-2 px-3 text-sm cursor-pointer rounded-full border border-gray-400 text-gray-300">Follow</button>
                            <button class="fill-gray-100 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
                                    <path
                                        d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128Zm56-12a12,12,0,1,0,12,12A12,12,0,0,0,196,116ZM60,116a12,12,0,1,0,12,12A12,12,0,0,0,60,116Z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Profile Section like Instagram -->
                    <div class="flex items-center">
                        <div class="flex-1">
                            <!-- Stats like TikTok/IG -->
                            <div class="flex text-sm text-gray-500 transition-all">
                                <a href="#posts" class="hover:bg-red-500 px-4 py-3 cursor-pointer">
                                    <span class="font-semibold text-gray-200 text-[16px] mr-1">{{ $user->posts->count() }}</span> Posts
                                </a>
                                <div class="hover:bg-red-500 px-4 py-3 cursor-pointer">
                                    <span class="font-semibold text-gray-200 text-[16px] mr-1">{{ $user->followers->count() }}</span> Followers
                                </div>
                                <div class="hover:bg-red-500 px-4 py-3 cursor-pointer">
                                    <span class="font-semibold text-gray-200 text-[16px] mr-1">{{ $user->followings->count() }}</span> Following
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="mt-3 font-semibold">
                        <h1>{{ $user->name }}</h1>
                    </div>

                    <!-- Bio -->
                    <div class="mt-3 text-sm leading-relaxed">
                        <p>{{ $user->bio }}</p>
                    </div>
                </div>
            </div>

            <!-- Tabs for Posts / Collections -->
            <div class="flex gap-6 mb-6 text-sm font-medium border-b border-gray-800 mt-8 justify-center">
                <div class="w-1/3 text-center">
                    <button class="tab-btn pb-3 cursor-pointer" :class="tab === 'posts' ? 'text-white border-b-2 border-white' : 'text-gray-500'"
                        @click="tab = 'posts'">

                        Posts
                    </button>
                </div>
                <div class="w-1/3 text-center">
                    <button class="tab-btn pb-3 cursor-pointer"
                        :class="tab === 'collections' ? 'text-white border-b-2 border-white' : 'text-gray-500'"
                        @click="tab = 'collections'">Collections</button>
                </div>
            </div>

            <!-- SLIDER WRAPPER -->
            <div class="overflow-hidden relative w-full">
                <div class="flex transition-transform duration-300 ease-in-out w-[200%]"
                    :style="tab === 'posts' ? 'transform: translateX(0%)' : 'transform: translateX(-50%)'">

                    <!-- POSTS GRID -->
                    <div class="w-full flex flex-col pr-4" id="posts">
                        @foreach ($posts as $post)
                        <livewire:posts.item wire:key="{{ $post->id }}" :$post />
                        @endforeach
                    </div>

                    <!-- COLLECTIONS GRID -->
                    <div class="w-full grid gap-20 justify-center @if ($user->collections->count() != 0) grid-cols-3 @endif" id="collections">
                        @forelse ($user->collections as $collection)
                        <a href="{{ route('collections.show', $collection) }}" class="relative rounded-4xl h-80 w-56 flex flex-col items-center text-sm">
                            @if ($collection->posts->count() > 0)
                            <div class="relative translate-x-1/6 w-full h-full z-10">
                                <img class="absolute left-0 top-0 w-full h-full object-cover rounded-4xl scale-90 -translate-x-1/6 opacity-80" src="{{ $collection->posts->first()->images->first()->url ?? "" }}">
                                <img class="absolute left-0 top-0 w-full h-full object-cover rounded-4xl z-10 shadow-2xl" src="{{ $collection->posts->random()->images->first()->url ?? "" }}">
                                <img class="absolute left-0 top-0 w-full h-full object-cover rounded-4xl scale-90 translate-x-1/6 opacity-80" src="{{ $collection->posts->last()->images->first()->url ?? "" }}">
                            </div>
                            @endif
                            <span class="mt-5 text-lg text-white">{{ ucwords($collection->name) }}</span>
                            <span class="text-gray-400">{{ $user->name }}</span>
                        </a>
                        @empty
                        <div class="w-full text-center text-gray-400">No colletions yet.</div>
                        @endforelse
                    </div>

                </div>
            </div>

            <style>
                /* Optional smoother feel */
                #slider-wrapper div {
                    transition: transform 0.3s ease-in-out;
                }
            </style>
        </div>
    </div>
</x-layouts.app>
