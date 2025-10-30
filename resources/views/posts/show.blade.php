<x-layouts.app title="Posts" header="Posts">
    <div class="flex flex-col items-center">
        <article class="w-7/12 flex flex-col gap-7">
            {{-- Title --}}
            <div class="mb-3 mt-2">
                <h1 class="text-4xl font-semibold">{{ ucfirst($post->title) }}</h1>
                <p class="text-xl text-gray-400 mt-4">{{ ucfirst($post->excerpt) }}</p>
            </div>

            {{-- Author --}}
            <div class="flex space-x-5 items-center -mt-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full overflow-hidden">
                        <img src="{{ $post->author->image->url }}" alt="Foto penulis">
                    </div>
                    <div class="flex text-sm text-gray-300">
                        <div class="text-white">{{ $post->author->name }}</div>
                    </div>
                </div>
                
                {{-- Follow --}}
                <div class="flex items-center space-x-4 text-sm text-gray-300">
                    <button class="py-2 px-3 cursor-pointer rounded-full border border-gray-400 text-gray-300">Follow</button>
                    <div>{{ $post->created_at->format('M d, o') }}</div>
                </div>
            </div>

            {{-- Action Button --}}
            <div class="flex items-center justify-between py-4 border-t border-b border-gray-800 text-sm">
                <div class="flex items-center space-x-7">
                    {{-- Claps --}}
                    <button class="flex items-center space-x-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="#99a1af" viewBox="0 0 256 256">
                            <path
                                d="M160.22,24V8a8,8,0,0,1,16,0V24a8,8,0,0,1-16,0ZM196.1,41a7.91,7.91,0,0,0,4.17,1.17,8,8,0,0,0,6.84-3.83l8-13.11a8,8,0,0,0-13.68-8.33l-8,13.1A8,8,0,0,0,196.1,41Zm47.51,12.59a8,8,0,0,0-10.08-5.16l-15.06,4.85a8,8,0,0,0,2.46,15.62,8.15,8.15,0,0,0,2.46-.39l15.05-4.85A8,8,0,0,0,243.61,53.55ZM217,97.58a80.22,80.22,0,0,1-10.22,94c-.34,1.73-.72,3.46-1.19,5.18A80.17,80.17,0,0,1,58.77,216L23.5,155a26,26,0,0,1,19.24-38.79l-3-5.2a26,26,0,0,1,19.2-38.78L58.24,71A26,26,0,0,1,95.47,36.53,26.06,26.06,0,0,1,140.3,37l12.26,21.2A26.07,26.07,0,0,1,195.81,61ZM109.07,55l0,0h0l25,43.17a26,26,0,0,1,17.33-10L126.42,45a10,10,0,1,0-17.35,10ZM72.12,63l6.46,11.17a26.05,26.05,0,0,1,17.32-10L89.45,53A10,10,0,1,0,72.12,63Zm111.54,81-20.22-35a10,10,0,0,0-17.74,9.25L158.3,140a8,8,0,0,1-13.87,8l-36.5-63A10,10,0,1,0,90.58,95l26.05,45a8,8,0,0,1-13.87,8L71,93h0l0,0a10,10,0,0,0-17.33,10l35.22,61A8,8,0,0,1,75,172L54.72,137a10,10,0,0,0-17.34,10l35.27,61a64.12,64.12,0,0,0,117.42-15.44A63.52,63.52,0,0,0,183.66,144Zm19.41-38.42L181.93,69A10,10,0,0,0,164.55,79l33,57.05A80.2,80.2,0,0,1,207,161.51,64.23,64.23,0,0,0,203.07,105.58Z">
                            </path>
                        </svg>
                        <span>{{ number_format($post->claps->sum('count')) }}</span>
                    </button>
                    {{-- Comments --}}
                    <button class="flex items-center space-x-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#99a1af" viewBox="0 0 256 256">
                            <path
                                d="M128,24A104,104,0,0,0,36.18,176.88L24.83,210.93a16,16,0,0,0,20.24,20.24l34.05-11.35A104,104,0,1,0,128,24Zm0,192a87.87,87.87,0,0,1-44.06-11.81,8,8,0,0,0-6.54-.67L40,216,52.47,178.6a8,8,0,0,0-.66-6.54A88,88,0,1,1,128,216Z">
                            </path>
                        </svg>
                        <span>{{ number_format($post->comments->count()) }}</span>
                    </button>
                </div>

                <div class="flex items-center space-x-7">
                    {{-- Bookmark --}}
                    <button type="button" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#99a1af" viewBox="0 0 256 256">
                            <path
                                d="M184,32H72A16,16,0,0,0,56,48V224a8,8,0,0,0,12.24,6.78L128,193.43l59.77,37.35A8,8,0,0,0,200,224V48A16,16,0,0,0,184,32Zm0,177.57-51.77-32.35a8,8,0,0,0-8.48,0L72,209.57V48H184Z">
                            </path>
                        </svg>
                    </button>

                    {{-- Share --}}
                    <button type="button" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#99a1af" viewBox="0 0 256 256">
                            <path
                                d="M216,112v96a16,16,0,0,1-16,16H56a16,16,0,0,1-16-16V112A16,16,0,0,1,56,96H80a8,8,0,0,1,0,16H56v96H200V112H176a8,8,0,0,1,0-16h24A16,16,0,0,1,216,112ZM93.66,69.66,120,43.31V136a8,8,0,0,0,16,0V43.31l26.34,26.35a8,8,0,0,0,11.32-11.32l-40-40a8,8,0,0,0-11.32,0l-40,40A8,8,0,0,0,93.66,69.66Z">
                            </path>
                        </svg>
                    </button>

                    {{-- More Options --}}
                    <button type="button" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#99a1af" viewBox="0 0 256 256">
                            <path
                                d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128Zm56-12a12,12,0,1,0,12,12A12,12,0,0,0,196,116ZM60,116a12,12,0,1,0,12,12A12,12,0,0,0,60,116Z">
                            </path>
                        </svg>
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
                <a href="{{ route('tags.show', $tag->slug) }}" class="py-3 px-4 text-sm rounded-full bg-gray-800">{{ $tag->name }}</a>
            </span>
            @endforeach
            </div>

            {{-- Action Button --}}
            <div class="flex items-center justify-between py-4 text-sm my-5">
                <div class="flex items-center space-x-7">
                    {{-- Claps --}}
                    <button class="flex items-center space-x-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="#99a1af" viewBox="0 0 256 256">
                            <path
                                d="M160.22,24V8a8,8,0,0,1,16,0V24a8,8,0,0,1-16,0ZM196.1,41a7.91,7.91,0,0,0,4.17,1.17,8,8,0,0,0,6.84-3.83l8-13.11a8,8,0,0,0-13.68-8.33l-8,13.1A8,8,0,0,0,196.1,41Zm47.51,12.59a8,8,0,0,0-10.08-5.16l-15.06,4.85a8,8,0,0,0,2.46,15.62,8.15,8.15,0,0,0,2.46-.39l15.05-4.85A8,8,0,0,0,243.61,53.55ZM217,97.58a80.22,80.22,0,0,1-10.22,94c-.34,1.73-.72,3.46-1.19,5.18A80.17,80.17,0,0,1,58.77,216L23.5,155a26,26,0,0,1,19.24-38.79l-3-5.2a26,26,0,0,1,19.2-38.78L58.24,71A26,26,0,0,1,95.47,36.53,26.06,26.06,0,0,1,140.3,37l12.26,21.2A26.07,26.07,0,0,1,195.81,61ZM109.07,55l0,0h0l25,43.17a26,26,0,0,1,17.33-10L126.42,45a10,10,0,1,0-17.35,10ZM72.12,63l6.46,11.17a26.05,26.05,0,0,1,17.32-10L89.45,53A10,10,0,1,0,72.12,63Zm111.54,81-20.22-35a10,10,0,0,0-17.74,9.25L158.3,140a8,8,0,0,1-13.87,8l-36.5-63A10,10,0,1,0,90.58,95l26.05,45a8,8,0,0,1-13.87,8L71,93h0l0,0a10,10,0,0,0-17.33,10l35.22,61A8,8,0,0,1,75,172L54.72,137a10,10,0,0,0-17.34,10l35.27,61a64.12,64.12,0,0,0,117.42-15.44A63.52,63.52,0,0,0,183.66,144Zm19.41-38.42L181.93,69A10,10,0,0,0,164.55,79l33,57.05A80.2,80.2,0,0,1,207,161.51,64.23,64.23,0,0,0,203.07,105.58Z">
                            </path>
                        </svg>
                        <span>{{ number_format($post->claps->sum('count')) }}</span>
                    </button>
                    {{-- Comments --}}
                    <button class="flex items-center space-x-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#99a1af" viewBox="0 0 256 256">
                            <path
                                d="M128,24A104,104,0,0,0,36.18,176.88L24.83,210.93a16,16,0,0,0,20.24,20.24l34.05-11.35A104,104,0,1,0,128,24Zm0,192a87.87,87.87,0,0,1-44.06-11.81,8,8,0,0,0-6.54-.67L40,216,52.47,178.6a8,8,0,0,0-.66-6.54A88,88,0,1,1,128,216Z">
                            </path>
                        </svg>
                        <span>{{ number_format($post->comments->count()) }}</span>
                    </button>
                </div>
            
                <div class="flex items-center space-x-7">
                    {{-- Bookmark --}}
                    <button type="button" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#99a1af" viewBox="0 0 256 256">
                            <path
                                d="M184,32H72A16,16,0,0,0,56,48V224a8,8,0,0,0,12.24,6.78L128,193.43l59.77,37.35A8,8,0,0,0,200,224V48A16,16,0,0,0,184,32Zm0,177.57-51.77-32.35a8,8,0,0,0-8.48,0L72,209.57V48H184Z">
                            </path>
                        </svg>
                    </button>
            
                    {{-- Share --}}
                    <button type="button" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#99a1af" viewBox="0 0 256 256">
                            <path
                                d="M216,112v96a16,16,0,0,1-16,16H56a16,16,0,0,1-16-16V112A16,16,0,0,1,56,96H80a8,8,0,0,1,0,16H56v96H200V112H176a8,8,0,0,1,0-16h24A16,16,0,0,1,216,112ZM93.66,69.66,120,43.31V136a8,8,0,0,0,16,0V43.31l26.34,26.35a8,8,0,0,0,11.32-11.32l-40-40a8,8,0,0,0-11.32,0l-40,40A8,8,0,0,0,93.66,69.66Z">
                            </path>
                        </svg>
                    </button>
            
                    {{-- More Options --}}
                    <button type="button" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#99a1af" viewBox="0 0 256 256">
                            <path
                                d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128Zm56-12a12,12,0,1,0,12,12A12,12,0,0,0,196,116ZM60,116a12,12,0,1,0,12,12A12,12,0,0,0,60,116Z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Author Info --}}
            <div class="flex justify-between">
                <div class="flex space-x-5">
                {{--Avatar --}}
                    <div class="flex space-x-3">
                        <div class="w-12 h-12 rounded-full overflow-hidden">
                            <img src="{{ $post->author->image->url }}" alt="Foto penulis">
                        </div>
                    </div>

                    {{-- Author Profile --}}
                    <div class="flex flex-col justify-baseline space-y-3">
                        <h2 class="text-xl">Written by {{ $post->author->name }}</h2>

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

            <div class="flex flex-col space-y-7 w-full">
            @foreach ($post->comments as $comment)
                <div class="flex flex-col space-y-4 border-b border-gray-800 pb-6 w-full">
                    {{-- Comment Author --}}
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 text-sm rounded-full overflow-hidden flex items-center justify-center">
                            <img src="{{ $comment->author->image->url }}" alt="Author Photo" class="w-full h-full object-cover">
                        </div>
                        <div class="text-sm text-gray-300 flex flex-col">
                            <div class="text-white">{{ $comment->author->name }}</div>
                            <div>{{ $post->created_at->format('M d') }}</div>
                        </div>
                    </div>

                    {{-- Comment Body --}}
                    <div>
                        <p class="text-sm leading-8">{{ $comment->body }}</p>
                    </div>

                    {{-- Action button --}}
                    <div class="flex items-center text-sm space-x-4">
                        {{-- Claps --}}
                        <div class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="#99a1af" viewBox="0 0 256 256">
                                <path
                                    d="M160.22,24V8a8,8,0,0,1,16,0V24a8,8,0,0,1-16,0ZM196.1,41a7.91,7.91,0,0,0,4.17,1.17,8,8,0,0,0,6.84-3.83l8-13.11a8,8,0,0,0-13.68-8.33l-8,13.1A8,8,0,0,0,196.1,41Zm47.51,12.59a8,8,0,0,0-10.08-5.16l-15.06,4.85a8,8,0,0,0,2.46,15.62,8.15,8.15,0,0,0,2.46-.39l15.05-4.85A8,8,0,0,0,243.61,53.55ZM217,97.58a80.22,80.22,0,0,1-10.22,94c-.34,1.73-.72,3.46-1.19,5.18A80.17,80.17,0,0,1,58.77,216L23.5,155a26,26,0,0,1,19.24-38.79l-3-5.2a26,26,0,0,1,19.2-38.78L58.24,71A26,26,0,0,1,95.47,36.53,26.06,26.06,0,0,1,140.3,37l12.26,21.2A26.07,26.07,0,0,1,195.81,61ZM109.07,55l0,0h0l25,43.17a26,26,0,0,1,17.33-10L126.42,45a10,10,0,1,0-17.35,10ZM72.12,63l6.46,11.17a26.05,26.05,0,0,1,17.32-10L89.45,53A10,10,0,1,0,72.12,63Zm111.54,81-20.22-35a10,10,0,0,0-17.74,9.25L158.3,140a8,8,0,0,1-13.87,8l-36.5-63A10,10,0,1,0,90.58,95l26.05,45a8,8,0,0,1-13.87,8L71,93h0l0,0a10,10,0,0,0-17.33,10l35.22,61A8,8,0,0,1,75,172L54.72,137a10,10,0,0,0-17.34,10l35.27,61a64.12,64.12,0,0,0,117.42-15.44A63.52,63.52,0,0,0,183.66,144Zm19.41-38.42L181.93,69A10,10,0,0,0,164.55,79l33,57.05A80.2,80.2,0,0,1,207,161.51,64.23,64.23,0,0,0,203.07,105.58Z">
                                </path>
                            </svg>
                            <span>{{ number_format($comment->claps->sum('count')) }}</span>
                        </div>
                        
                        {{-- Reply --}}
                        <a href="#" class="underline">Reply</a>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>