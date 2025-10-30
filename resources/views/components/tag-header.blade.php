@props(['tags'])

<div class="flex items-center space-x-2 overflow-x-scroll whitespace-nowrap no-scrollbar">
    <a href="{{ route('tags.index') }}" 
    class="py-2 pl-2 pr-4 text-sm rounded-full bg-gray-800 flex items-center space-x-2 mr-6 fill-gray-200{{ request()->url() == route('tags.index') ? ' border border-gray-200 fill-gray-800' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 256 256"
        class="rounded-full{{ request()->url() == route('tags.index') ? ' bg-gray-200' : '' }}"
        >
            <path
                d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216ZM172.42,72.84l-64,32a8.05,8.05,0,0,0-3.58,3.58l-32,64A8,8,0,0,0,80,184a8.1,8.1,0,0,0,3.58-.84l64-32a8.05,8.05,0,0,0,3.58-3.58l32-64a8,8,0,0,0-10.74-10.74ZM138,138,97.89,158.11,118,118l40.15-20.07Z">
            </path>
        </svg>
        <span>Explore topics</span>
    </a>
    
    @foreach ($tags as $item)
    <a href="{{ route('tags.show', $item->slug) }}"
        class="py-2.5 px-4 text-sm rounded-full bg-gray-800{{ request()->url() == route('tags.show', $item->slug) ? ' border border-gray-200' : '' }}">
        {{ ucwords($item->name) }}
    </a>
    @endforeach
</div>