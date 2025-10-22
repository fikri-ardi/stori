<x-layouts.app title="Posts" header="From the blog">
    <div class="flex flex-wrap justify-between space-y-10">
        @foreach ($posts as $post)
            <article class="md:max-w-[368px] flex flex-col justify-between">
                {{-- Banner --}}
                <div class="w-full h-56 mb-7">
                    <a href="{{ route('posts.show', $post->slug) }}">
                        <img src="{{ $post->images->first()->url ?? '' }}" alt="Gambar Post" class="w-full h-full object-cover rounded-2xl">
                    </a>
                </div>

                {{-- Content --}}
                <div>
                    <div class="flex items-center space-x-4 text-xs text-gray-400 mb-4">
                        {{-- Date --}}
                        <div class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="#99a1af" viewBox="0 0 256 256">
                                <path
                                    d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Zm-68-76a12,12,0,1,1-12-12A12,12,0,0,1,140,132Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,184,132ZM96,172a12,12,0,1,1-12-12A12,12,0,0,1,96,172Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,140,172Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,184,172Z">
                                </path>
                            </svg>
                            <span>
                                {{ $post->created_at->format('M d') }}
                            </span>
                        </div>

                        {{-- Views --}}
                        <div class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#99a1af" viewBox="0 0 256 256">
                                <path
                                    d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z">
                                </path>
                            </svg>
                            <span>{{ number_format($post->visitors->count()) }}</span>
                        </div>

                        
                        {{-- Claps --}}
                        <div class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="#99a1af" viewBox="0 0 256 256">
                                <path
                                    d="M160.22,24V8a8,8,0,0,1,16,0V24a8,8,0,0,1-16,0ZM196.1,41a7.91,7.91,0,0,0,4.17,1.17,8,8,0,0,0,6.84-3.83l8-13.11a8,8,0,0,0-13.68-8.33l-8,13.1A8,8,0,0,0,196.1,41Zm47.51,12.59a8,8,0,0,0-10.08-5.16l-15.06,4.85a8,8,0,0,0,2.46,15.62,8.15,8.15,0,0,0,2.46-.39l15.05-4.85A8,8,0,0,0,243.61,53.55ZM217,97.58a80.22,80.22,0,0,1-10.22,94c-.34,1.73-.72,3.46-1.19,5.18A80.17,80.17,0,0,1,58.77,216L23.5,155a26,26,0,0,1,19.24-38.79l-3-5.2a26,26,0,0,1,19.2-38.78L58.24,71A26,26,0,0,1,95.47,36.53,26.06,26.06,0,0,1,140.3,37l12.26,21.2A26.07,26.07,0,0,1,195.81,61ZM109.07,55l0,0h0l25,43.17a26,26,0,0,1,17.33-10L126.42,45a10,10,0,1,0-17.35,10ZM72.12,63l6.46,11.17a26.05,26.05,0,0,1,17.32-10L89.45,53A10,10,0,1,0,72.12,63Zm111.54,81-20.22-35a10,10,0,0,0-17.74,9.25L158.3,140a8,8,0,0,1-13.87,8l-36.5-63A10,10,0,1,0,90.58,95l26.05,45a8,8,0,0,1-13.87,8L71,93h0l0,0a10,10,0,0,0-17.33,10l35.22,61A8,8,0,0,1,75,172L54.72,137a10,10,0,0,0-17.34,10l35.27,61a64.12,64.12,0,0,0,117.42-15.44A63.52,63.52,0,0,0,183.66,144Zm19.41-38.42L181.93,69A10,10,0,0,0,164.55,79l33,57.05A80.2,80.2,0,0,1,207,161.51,64.23,64.23,0,0,0,203.07,105.58Z">
                                </path>
                            </svg>
                            <span>{{ number_format($post->claps->sum('count')) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('posts.show', $post->slug) }}">
                        <h2 class="text-xl font-semibold">{{ str($post->title)->lower()->ucfirst() }}</h2>
                        <p class="text-gray-400 leading-relaxed mt-5 mb-7">{{ $post->excerpt }}</p>
                    </a>
                </div>
            
                {{-- Author --}}
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 text-sm rounded-full overflow-hidden flex items-center justify-center">
                        <img src="{{ $post->author->image->url }}" alt="Author Photo" class="w-full h-full object-cover">
                    </div>
                    <div class="text-sm text-gray-300 flex flex-col space-y-1">
                        <div class="font-semibold text-white">{{ $post->author->name }}</div>
                        <div>{{ ucwords($post->author->role->name) }}</div>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</x-layouts.app>